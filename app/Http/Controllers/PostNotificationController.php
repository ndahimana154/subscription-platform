<?php

namespace App\Http\Controllers;

use App\Mail\PostNotification;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class PostNotificationController extends Controller
{
    public function notifySubscribers($postId)
    {
        // Find the post by ID
        $post = Post::findOrFail($postId);

        // Get the website ID from the post (assuming there's a relationship set)
        $websiteId = $post->website_id;

        // Retrieve all subscriptions for the given website
        $subscriptions = Subscription::where('website_id', $websiteId)->get();

        // Check if there are any subscribers
        if ($subscriptions->isEmpty()) {
            return Response::json(['message' => 'No subscribers found for this website.'], 404);
        }

        // Prepare an array to hold the subscriber emails
        $subscriberEmails = $subscriptions->pluck('user_email');

        // Send email notifications to each subscriber
        foreach ($subscriberEmails as $email) {
            Mail::to($email)->send(new PostNotification($post));
        }

        return Response::json(['message' => 'Notifications sent to subscribers.'], 200);
    }
}
