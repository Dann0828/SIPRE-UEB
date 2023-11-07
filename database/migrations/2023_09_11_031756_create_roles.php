<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role1 = Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $role2 = Spatie\Permission\Models\Role::create(['name' => 'tecnico']);
        $role3 = Spatie\Permission\Models\Role::create(['name' => 'otro']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};