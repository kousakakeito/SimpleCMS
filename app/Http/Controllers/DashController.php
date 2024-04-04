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


class DashController extends Controller
{
    public function showDashForm()
    {
        return view('dashboard.form.dash_form');
    }

    public function showCateForm()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)
                                ->orderBy('order', 'asc')
                                ->get();
        return view('dashboard.form.cate_form', compact('categories')); 
    }

    public function showCateChangeForm()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        return view('dashboard.form.cate_changeform', compact('categories')); 
    }

    public function changeCategory(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:categories,id' 
        ]);
        
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            $category = Category::find($id);
            if ($category) {
                $category->order = $position;
                $category->save();
            }
        }
        
        return redirect()->back()->with('success', 'カテゴリが正常に更新されました！');
    }

    public function showCateEditForm(Request $request)
    {
        $name = $request->input('name');
        
        $category = Category::where('name', $name)->firstOrFail();
        
        return view('dashboard.form.cate_editform', ['category' => $category]); 
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $request->category_id,
            'description' => 'sometimes|required|string',
        ]);
    
        $category = Category::findOrFail($request->category_id);
    
        $updateData = $request->only(['name', 'description']);

        $category->update($updateData);
    
        return redirect()->back()->with('success', 'カテゴリが正常に更新されました！');
    }

    public function showCateDeleteForm(Request $request)
    {
        $categoryName = $request->input('name');
        
        return view('dashboard.form.cate_deleteform', ['name' => $categoryName]);
       
    }

    public function deleteCategory(Request $request)
    {
        $categoryName = $request->input('name');

        Category::where('name', $categoryName)->delete();

        return redirect()->back()->with('success', 'カテゴリが正常に削除されました！');
    }

    public function showCateForm2()
    {
        return view('dashboard.form.cate_form2');
    }

    public function showNoticeForm()
    {
        $userId = Auth::id();
        $notices = Notice::where('user_id', $userId)
                           ->orderBy('created_at', 'asc')
                           ->get();
    
        return view('dashboard.form.notice_form', ['notices' => $notices]);
    }

    public function searchNotices(Request $request)
    {
        $keyword = $request->input('search');
        if (!empty($keyword)) {
         $notices = Notice::where('title', 'LIKE', "%{$keyword}%")->get();
        } else {
         $notices = Notice::all();
        }
        return view('dashboard.form.notice_searchcontent', compact('notices'));
    }

    public function showNoticeEditForm(Request $request)
    {
        
        $noticeName = $request->input('name');

        $notice = Notice::where('title', $noticeName)->firstOrFail();

        $categories = Category::orderBy('order', 'asc')->get();

        return view('dashboard.form.notice_editform', ['notice' => $notice, 'categories' => $categories]);
    }

    public function updateNotice(Request $request)
    {
        $request->validate([
            'notice_id' => 'required|integer|exists:notices,id',
            'post_date' => 'required|date',
            'title' => 'required|string|max:255|unique:notices,title,' . $request->notice_id,
            'category' => 'required|integer|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|file|image', 
            'display_flag' => 'nullable|boolean',
        ]);
    
        $notice = Notice::findOrFail($request->notice_id);
    
        $updateData = [
            'post_date' => $request->post_date,
            'title' => $request->title,
            'category_id' => $request->category,
            'content' => $request->content,
            'display_flag' => $request->has('display_flag') ? true : false,
        ];
    
        // 画像がアップロードされた場合の処理
        if ($request->hasFile('image')) {
            if ($notice->image_path && Storage::exists($notice->image_path)) {
                Storage::delete($notice->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('public/images');
        }
    
        $notice->update($updateData);
    
        return redirect()->back()->with('success', 'お知らせが正常に更新されました！');
    }

    public function showNoticeDeleteForm(Request $request)
    {
        $noticeName = $request->input('name');
        
        return view('dashboard.form.notice_deleteform', ['name' => $noticeName]);
       
    }

    public function deleteNotice(Request $request)
    {
        $noticeName = $request->input('name');

        Notice::where('title', $noticeName)->delete();

        return redirect()->back()->with('success', 'お知らせが正常に削除されました！');
    }

    public function showNoticeForm2()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        return view('dashboard.form.notice_form2', compact('categories'));
    }

    public function imageStore(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $filename, 'public');
            $url = Storage::url($filePath);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded.'], 422);
    }

    public function CateStore(Request $request)
    {
        $request->validate([
          'name' => 'required|string|max:255|unique:categories,name',
          'description' => 'required|string',
        ]);

        $category = new Category();
        $maxOrder = Category::max('order');
        $category->order = $maxOrder + 1;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_id = auth()->user()->id; 
        $category->save();

        return redirect()->back()->with('success', 'カテゴリが正常に登録されました。');
    }

    public function NoticeStore(Request $request)
    {
        $request->validate([
            'post_date' => 'required|date',
            'title' => 'required|string|max:255|unique:notices,title',
            'category' => 'required|integer',
            'content' => 'required|string',
            'image' => 'nullable|image',
            'display_flag' => 'nullable|boolean',
        ]);

        $notice = new Notice();
        $notice->user_id = auth()->user()->id; 
        $notice->post_date = $request->post_date;
        $notice->title = $request->title;
        $notice->category_id = $request->category; 
        $notice->content = $request->content;
        $notice->display_flag = $request->has('display_flag'); 

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('public/images');
            $notice->image_path = $filename; 
        }

        $notice->save(); 

        return redirect()->back()->with('success', 'お知らせが正常に登録されました。');
    }

    public function showContactForm()
    {
        $userId = Auth::id();
        
        $contacts = Contact::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get(['name', 'subject', 'created_at', 'id']); 

        return view('dashboard.form.contact_form', compact('contacts')); 
    }

    public function showContactDeleteForm(Request $request)
    {
        $name = $request->input('name');
        $subject = $request->input('subject');

        return view('dashboard.form.contact_deleteform', compact('name', 'subject'));
    }

    public function showContactDetailForm(Request $request)
    {
        $name = $request->input('name');
        $subject = $request->input('subject');
    
        $contacts = Contact::where('name', $name)
                          ->where('subject', $subject)
                          ->first(['email', 'message','name']);

        return view('dashboard.form.contact_detail', compact('contacts')); 
    }

    public function deleteContact(Request $request)
    {
        $userId = Auth::id();
        $name = $request->input('name');
        $subject = $request->input('subject');
    
        $contact = Contact::where('user_id', $userId)
                          ->where('name', $name)
                          ->where('subject', $subject)
                          ->first();
    
        if ($contact) {
            $contact->delete();
            return redirect()->back()->with('success', 'メッセージが正常に削除されました！');
        } else {
            return redirect()->back()->with('error', '指定されたメッセージは見つかりませんでした。');
        }
    }

    public function show($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return view('users.show', compact('user'));
    }

}
