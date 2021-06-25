<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZohosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoho_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->bigInteger('owner_id')->nullable();
            $table->string('owner_name')->nullable()->collation('utf8_general_ci');
            $table->string('owner_email')->nullable()->collation('utf8_general_ci');
           // $table->string('ownership')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable()->collation('utf8_general_ci');
            $table->string('secondary_email')->nullable()->collation('utf8_general_ci');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable()->collation('utf8_general_ci');
            $table->string('currency_symbol')->nullable();
            $table->string('currency')->nullable();
            $table->string('visitor_score')->nullable();
            $table->string('mailing_street')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('mailing_country')->nullable();
            $table->string('mailing_zip')->nullable();
            $table->string('department')->nullable();
            $table->string('unsubscribed_mode')->nullable();
            $table->string('unsubscribed_time')->nullable();
            $table->string('conversion_exported_on')->nullable();
            $table->string('conversion_export_status')->nullable();
            $table->string('reason_for_conversion_failure')->nullable();
            $table->string('cost_per_click')->nullable();
            $table->string('cost_per_conversion')->nullable();
            $table->string('first_visited_url')->nullable();
            $table->string('days_visited')->nullable();
            $table->string('click_type')->nullable();
            $table->string('ad')->nullable();
            $table->string('ad_network')->nullable();
            $table->string('ad_group_name')->nullable();
            $table->string('ad_click_date')->nullable();
            $table->string('ad_campaign_name')->nullable();
            $table->string('number_of_chats')->nullable();
            $table->string('search_partner_network')->nullable();
            $table->string('average_time_spent_minutes')->nullable();
            $table->string('salutation')->nullable();
            $table->string('email_opt_out')->nullable();
            $table->string('keyword')->nullable();
            $table->string('device_type')->nullable();
            $table->string('referrer')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('exchange_rate')->nullable();
            $table->string('tag')->nullable();
            $table->string('GCLID')->nullable();
            $table->string('state')->nullable();
            $table->string('review')->nullable();
           // $table->string('website')->nullable();
           // $table->string('employees')->nullable();
           // $table->string('source')->nullable();
           // $table->string('rating')->nullable();
            $table->string('last_activity_time')->nullable();
            $table->string('last_visited_time')->nullable();
            //$table->string('industry')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->string('account_name')->nullable();
           // $table->string('parent_account')->nullable();
            // $table->string('shipping_street')->nullable();
            // $table->string('shipping_city')->nullable();
            // $table->string('shipping_state')->nullable();
            // $table->string('shipping_country')->nullable();
            // $table->string('shipping_code')->nullable();
            // $table->string('billing_street')->nullable();
            // $table->string('billing_city')->nullable();
            // $table->string('billing_country')->nullable();
            // $table->string('billing_state')->nullable();
            // $table->string('billing_code')->nullable();
            $table->string('created_time')->nullable();
            $table->bigInteger('created_by_id')->nullable();
            $table->string('created_by_name')->nullable()->collation('utf8_general_ci');
            $table->string('created_by_email')->nullable()->collation('utf8_general_ci');
            $table->string('modified_time')->nullable();
            $table->string('first_visited_time')->nullable();
            // $table->string('modified_by_id')->nullable();
            // $table->string('modified_by_name')->nullable()->collation('utf8_general_ci');
            // $table->string('modified_by_email')->nullable()->collation('utf8_general_ci');
           // $table->string('annual_revenue')->nullable();
            $table->string('approval_state')->nullable();
            $table->tinyInteger('approved')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('editable')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('orchestration')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('process_flow')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('review_process_approve')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('review_process_reject')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('review_process_resubmit')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('in_merge')->default(0)->comment('0 = false and 1 = true');
            $table->tinyInteger('is_active')->default(1)->comment('0 = inactive and 1 = active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zohos');
    }
}
