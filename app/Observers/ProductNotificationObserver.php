<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewProductNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductNotificationObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $admin = Admin::first();


        Notification::send($admin, new NewProductNotification($product));
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
