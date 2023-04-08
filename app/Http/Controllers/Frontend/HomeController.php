<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Contact;
use App\Models\News;
use App\Models\Newsletter;
use App\Models\Productlist;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Support;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
//        $sliders = Slider::where('status', 1)->orderBy('order', 'asc')->get();
//        $productLists = Productlist::where('status', 1)->get();
//        $about = About::first();
//        $services = Service::where('status', 1)->get()->take(6);
//        $projects = Project::where('status', 1)->get()->take(3);
//        $news = News::all();
//        $supports = Support::all();
        return view('frontend.index', get_defined_vars());
    }

    public function search(Request $request)
    {
        $searchPosts = PaylasimTranslation::where('title', 'LIKE', '%' . $request->s . '%')
            ->orWhere('content', 'LIKE', '%' . $request->s . '%')
            ->orWhere('description', 'LIKE', '%' . $request->s . '%')
            ->orWhere('keywords', 'LIKE', '%' . $request->s . '%')
            ->pluck('paylasim_id');
        $searchResult = [];
        foreach ($searchPosts as $key => $sp) {
            $postS = Paylasim::where('id', '=', convert_number($sp))
                ->where('status', '=', 1)
                ->where('admin_status', '=', 1)
                ->first();
            $searchResult[] = $postS;
        }
        $searchIndex = $request->s;
        $searchResult = array_unique($searchResult);
        return view('frontend.posts.search', get_defined_vars());
    }

    public function newsletter(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'newsletterEmail' => 'unique:newsletter|required|max:255',
            ]);
            $subscriber = Newsletter::create([
                'mail' => $request->newsletterEmail,
                'token' => md5(time()),
                'status' => 0,
            ]);
            $data = [
                'id' => $subscriber->id,
                'mail' => $subscriber->mail,
                'token' => $subscriber->token,
            ];
            Mail::send('backend.mail.newsletter', $data, function ($message) use ($subscriber) {
                $message->to($subscriber->mail);
                $message->subject('Email adresinizi təsdiq edin!');
            });
            return redirect()->back()->with('successMessage', __('messages.success'));
        } catch (Exception $e) {
            return redirect()->back()->with('errorMessage', __('messages.error'));
        }
    }

    public function verifyMail($id, $token)
    {
        $subscriber = Newsletter::find($id);
        if ($subscriber->token == $token) {
            $subscriber->update([
                'status' => 1,
            ]);
            return view('frontend.includes.mail');
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->title = $request->title;
            $contact->read_status = 0;
            $contact->message = $request->message;
            $contact->save();

            alert()->success(__('messages.success'));
            return redirect()->back()->with('successMessage', __('messages.send-success'));

        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back()->with('errorMessage', __('messages.error'));
        }
    }
}
