<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return Subscription::with('website')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email|unique:subscriptions,user_email,NULL,id,website_id,' . $request->website_id,
            'website_id' => 'required|exists:websites,id',
        ]);

        $subscription = Subscription::create($request->all());

        return response()->json($subscription, 201);
    }

    public function show($id)
    {
        $subscription = Subscription::with('website')->findOrFail($id);
        return response()->json($subscription);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $request->validate([
            'user_email' => 'required|email|unique:subscriptions,user_email,' . $id . ',id,website_id,' . $request->website_id,
            'website_id' => 'required|exists:websites,id',
        ]);

        $subscription->update($request->all());

        return response()->json($subscription);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return response()->json(null, 204);
    }
}
