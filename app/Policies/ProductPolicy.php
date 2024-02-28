<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }
    /**
     * Determine whether the user can see datail show models.
     */
    
    public function index(User $user, Product $product): bool

    {
    // Check if the user is the owner of the product
    $isOwner = $user->id === $product->user_id;

    // Check if the user has the 'show detail' permission
    $canShow = $user->hasPermissionTo('create-product') || 
           $user->hasPermissionTo('edit-product') || 
           $user->hasPermissionTo('delete-product');

    // Check if the user has the Admin role or Super-admin role
    $isAdminOrSuperAdmin = $user->hasRole(['Admin', 'Super Admin']);

    // Allow showing details if the user is Admin, Super-admin, or has 'show detail' permission
    return $isAdminOrSuperAdmin || $canShow || $isOwner;
    
    }
    /*
    public function showdetail(User $user, Product $product): bool

    {
    // Check if the user is the owner of the product
    $isOwner = $user->id === $product->user_id;

    // Check if the user has the 'show detail' permission
    $canShow = $user->hasPermissionTo('create-product') || 
           $user->hasPermissionTo('edit-product') || 
           $user->hasPermissionTo('delete-product');

    // Check if the user has the Admin role or Super-admin role
    $isAdminOrSuperAdmin = $user->hasRole(['Admin', 'Super Admin']);

    // Allow showing details if the user is Admin, Super-admin, or has 'show detail' permission
    return $isAdminOrSuperAdmin || $canShow || $isOwner;
    
    }
    */

    public function show(User $user, Product $product): bool
    {
        // Check if the user is Admin, Super-admin, or the owner of the product
        return $user->hasRole(['Admin', 'Super Admin']) || $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        //

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        /* 
        //Only admin and super-admin can create products
        return $user->hasRole('admin') || $user->hasRole('super-admin')||$user->hasPermissionTo('create-product');
        */

        // Check if the user is the owner of the product
        //$isOwner = $user->id === $product->user_id;

        // Check if the user has the 'show detail' permission
        $canShow = $user->hasPermissionTo('create-product') || $user->hasPermissionTo('edit-product') || $user->hasPermissionTo('delete-product');

        // Check if the user has the Admin role or Super-admin role
        $isAdminOrSuperAdmin = $user->hasRole(['Admin', 'Super Admin']);

        // Allow showing details if the user is Admin, Super-admin, or has 'show detail' permission
        return $isAdminOrSuperAdmin || $canShow;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        // Only admin and super-admin can update products
        return $user->hasRole('admin') || $user->hasRole('super-admin')||$user->hasPermissionTo('edit-product');

        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        //
        // Only admin and super-admin can delete products
        return $user->hasRole('admin') || $user->hasRole('super-admin')||$user->hasPermissionTo('delete-product');

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        //
    }
}
