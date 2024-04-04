<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrontController extends Controller
{
  public function showListContentForm(Request $request, $username)
  {
      try {
          $user = User::where('name', $username)->firstOrFail();
          $currentPage = $request->input('page', 1);
          $noticesQuery = Notice::whereHas('user', function ($query) use ($user) {
            return $query->where('id', $user->id);
          })
          ->with('category')
          ->where('display_flag', false);
          $totalNotices = $noticesQuery->count();
          $notices = $noticesQuery->skip(($currentPage - 1) * 12)->take(12)->get();
          $moreExists = ($currentPage * 12) < $totalNotices;
          $previousExists = $currentPage > 1;
  
          return view('users.form.content_list', compact('notices', 'moreExists', 'previousExists', 'currentPage'));
      } catch (ModelNotFoundException $e) {
          return response()->json(['error' => 'User not found.'], 404);
      }
  }

  public function showNextListForm(Request $request, $username)
  {
      try {
          $user = User::where('name', $username)->firstOrFail();
          $lastId = $request->input('lastId', null);
          $noticesQuery = Notice::whereHas('user', function ($query) use ($user) {
              return $query->where('id', $user->id);
          })
          ->with('category')
          ->where('display_flag', false);
  
          if (!is_null($lastId)) {
              $noticesQuery->where('id', '>', $lastId);
          }
          $currentPage = $request->input('page', 1); 
          $skip = ($currentPage - 1) * 12;
          $totalNotices = $noticesQuery->count();
          $notices = $noticesQuery->skip($skip)->take(12)->get();
          $moreExists = ($currentPage * 12) < $totalNotices;
          $previousExists = $currentPage > 1; 
  
          return view('users.form.content_list', compact('notices', 'moreExists', 'previousExists', 'currentPage'));
      } catch (ModelNotFoundException $e) {
          return response()->json(['error' => 'User not found.'], 404);
      }
  }

public function showBackListForm(Request $request, $username)
{
    try {
        $user = User::where('name', $username)->firstOrFail();
        $page = $request->input('page', 1);
        $currentPage = max($page, 1);
        $skip = ($currentPage - 1) * 12;
        $noticesQuery = Notice::where('user_id', $user->id)
                               ->where('display_flag', false)
                               ->with('category');
        $totalNotices = $noticesQuery->count();
        $notices = $noticesQuery->skip($skip)->take(12)->get();
        $moreExists = ($currentPage * 12) < $totalNotices;
        $previousExists = $currentPage > 1;

        return view('users.form.content_list', compact('notices', 'moreExists', 'previousExists', 'currentPage'));
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'User not found.'], 404);
    }
}

public function showDetailContentForm($username)
{
    $user = User::where('name', $username)->firstOrFail();
    
    $currentNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->latest()
                            ->first();

    $previousNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '<', $currentNotice->id)
                            ->latest()
                            ->first();
    
    $nextNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '>', $currentNotice->id)
                            ->first();
    
    return view('users.form.content_detail', compact('currentNotice', 'previousNotice', 'nextNotice'));
}

public function showPageDetailForm(Request $request,$username)
{
    $title = $request->input('title');
    $user = User::where('name', $username)->firstOrFail();
    
    $currentNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('title', $title)
                            ->first();

    $previousNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '<', $currentNotice->id)
                            ->latest()
                            ->first();
    
    $nextNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '>', $currentNotice->id)
                            ->first();
    
    return view('users.form.content_detail', compact('currentNotice', 'previousNotice', 'nextNotice'));
}

public function showItemDetailForm(Request $request,$username)
{
    $title = $request->input('title');
    $user = User::where('name', $username)->firstOrFail();
    
    $currentNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('title', $title)
                            ->first();

    $previousNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '<', $currentNotice->id)
                            ->latest()
                            ->first();

    $nextNotice = Notice::whereHas('user', function ($query) use ($user) {
                                return $query->where('id', $user->id);
                            })
                            ->where('display_flag', false)
                            ->where('id', '>', $currentNotice->id)
                            ->first();
    
    return view('users.form.content_detail', compact('currentNotice', 'previousNotice', 'nextNotice'));
}

public function showContactForm()
{
    return view('users.form.content_contact');
}

public function showContactForm1(Request $request, $username)
{
    $data = $request->only(['name', 'email', 'subject', 'message']);

    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|max:255',
        'message' => 'required',
    ]);

    return view('users.form.content_contact1', compact('validatedData'));
}

public function storeContactForm(Request $request, $username)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|max:255',
        'message' => 'required',
    ]);

    $user = User::where('name', $username)->firstOrFail();

    $contact = new Contact($validatedData);

    $contact->user_id = $user->id;

    $contact->save();

    return response()->json(['success' => true]);
}

}