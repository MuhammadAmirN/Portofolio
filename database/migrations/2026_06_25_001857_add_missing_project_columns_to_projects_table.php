<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            if (!Schema::hasColumn('projects', 'role')) {
                $table->string('role')->nullable()->after('tech_stack');
            }

            if (!Schema::hasColumn('projects', 'contribution_percentage')) {
                $table->integer('contribution_percentage')->default(100)->after('featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            if (Schema::hasColumn('projects', 'role')) {
                $table->dropColumn('role');
            }

            if (Schema::hasColumn('projects', 'contribution_percentage')) {
                $table->dropColumn('contribution_percentage');
            }
        });
    }
};
