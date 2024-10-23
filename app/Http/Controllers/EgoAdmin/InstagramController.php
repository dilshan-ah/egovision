<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Instagram;
use App\Models\EgoModels\InstagramPost;
use App\Models\EgoModels\Product;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstagramController extends Controller
{
    public function user()
    {
        $pageTitle = 'Instagram users';
        $instagrams = Instagram::all();
        return view('admin.instagram.index', compact('pageTitle', 'instagrams'));
    }

    public function createUser()
    {
        $pageTitle = 'Create instagram users';
        return view('admin.instagram.create', compact('pageTitle'));
    }

    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'access_token' => 'required|string',
            ], [
                'access_token.required' => 'The access token is required.',
            ]);

            $insta = new Instagram();

            $insta->name = $request->name;
            $insta->access_token = $request->access_token;

            $insta->save();

            $notify[] = ['success', 'Instagram user created successfully.'];
            return redirect()->route('insta.user.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', $th->getMessage()];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }

    public function editUser(string $id)
    {
        $insta = Instagram::where('id', $id)->first();
        $pageTitle = 'Edit instagram users';
        return view('admin.instagram.edit', compact('pageTitle', 'insta'));
    }

    public function updateUser(Request $request, string $id)
    {
        try {

            $insta = Instagram::where('id', $id)->first();

            $insta->name = $request->name;
            $insta->access_token = $request->access_token;

            $insta->save();

            $notify[] = ['success', 'Instagram user updated successfully.'];
            return redirect()->route('insta.user.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', $th->getMessage()];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }

    public function deleteUser(string $id)
    {
        try {

            $insta = Instagram::where('id', $id)->first();

            $insta->delete();

            $notify[] = ['success', 'Instagram user deleted successfully.'];
            return redirect()->back()->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', $th->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function managePost()
    {
        $pageTitle = "Instagram Posts";
        $instaBlogs = InstagramPost::all();
        return view('admin.instagram-blogs.index', compact('pageTitle','instaBlogs'));
    }

    public function createPost(Request $request)
    {
        $pageTitle = "Create Instagram Post";
        $allProducts = Product::all();
        $instaUsers = Instagram::all();
        $instaData = [];



        if ($request->has('posted_by')) {
            $userId = $request->posted_by;
            $instaUser = Instagram::findOrFail($userId);
            $accessToken = $instaUser->access_token;

            $response = Http::get("https://graph.instagram.com/me/media", [
                'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username',
                'access_token' => $accessToken,
            ]);

            if ($response->successful()) {
                $instaData = $response->json();
            }
        }

        return view('admin.instagram-blogs.create', compact('pageTitle', 'allProducts', 'instaUsers', 'instaData'));
    }

    public function fetchPosts($userId)
    {
        $instaUser = Instagram::findOrFail($userId);
        $accessToken = $instaUser->access_token;

        $response = Http::get("https://graph.instagram.com/me/media", [
            'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username',
            'access_token' => $accessToken,
        ]);

        if ($response->successful()) {
            return response()->json($response->json()['data']);
        }else{
            return response()->json([
                'userId' => $userId,
                'accessToken' => $accessToken,
                'response' => $response,
            ]);
        }

        return response()->json(['error' => 'Unable to fetch posts'], 500);
    }

    public function storePost(Request $request)
    {
        try {
            $instaPost = new InstagramPost();

            $instaPost->insta_user_id = $request->posted_by;
            $instaPost->post_id = $request->post;
            $instaPost->product_id = $request->product;
    
            $instaPost->save();

            $notify[] = ['success', 'Instagram blog created successfully.'];
            return redirect()->route('insta.user.managePost')->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', $th];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function deletePost(string $id)
    {
        try {

            $insta = InstagramPost::where('id', $id)->first();

            $insta->delete();

            $notify[] = ['success', 'Instagram post deleted successfully.'];
            return redirect()->back()->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', $th->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }
}
