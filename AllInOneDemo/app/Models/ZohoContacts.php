<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZohoContacts extends Model
{
    use HasFactory;

    protected $table = "zoho_contacts";
 
    protected $fillable = [
            'user_id',
            'owner_id',
            'owner_name',
            'owner_email',
            'first_name',
            'last_name',
            'full_name',
            'email',
            'secondary_email',
            'phone',
            'mobile',
            'description',
            'currency_symbol',
            'currency',
            'visitor_score',
            'mailing_street',
            'mailing_city',
            'mailing_state',
            'mailing_country',
            'mailing_zip',
            'department',
            'unsubscribed_mode',
            'unsubscribed_time',
            'conversion_exported_on',
            'conversion_export_status',
            'reason_for_conversion_failure',
            'cost_per_click',
            'cost_per_conversion',
            'first_visited_url',
            'days_visited',
            'click_type',
            'ad',
            'ad_network',
            'ad_group_name',
            'ad_click_date',
            'ad_campaign_name',
            'number_of_chats',
            'search_partner_network',
            'average_time_spent_minutes',
            'salutation',
            'email_opt_out',
            'keyword',
            'device_type',
            'referrer',
            'lead_source',
            'exchange_rate',
            'tag',
            'GCLID',
            'state',
            'review',
            'review_process_approve',
            'review_process_reject',
            'review_process_resubmit',
            'last_activity_time',
            'last_visited_time',
            'process_flow',
            'account_id',
            'account_name',
            'approved',
            'editable',
            'orchestration',
            'created_time',
            'created_by_id',
            'created_by_name',
            'created_by_email',
            'modified_time',
            'first_visited_time',
            'approval_state',
            'in_merge',
            'is_active'
    ];


}
