<?php
/**
 * Created by PhpStorm.
 * User: haonx
 * Date: 3/31/2017
 * Time: 7:16 PM
 */
use Illuminate\Support\Collection;

require_once 'vendor/autoload.php';
#Higher Order Messaging
$validators = Validators::make();
$validators->every->isValid(); #true
$validators->each->validateOrFail();
#
/**
 * @var Posts $posts
 */
$titles = $posts->map->title;

seed_users()->each->addToUserGroup();
seed_users()->every->sendEmail('title', 'content');
seed_users()->filter->isVip()->each->sendEmailInvite();
seed_users()->filter->isPaidUser()->each->sendThankYou();
