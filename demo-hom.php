<?php
/**
 * Created by PhpStorm.
 * User: haonx
 * Date: 3/31/2017
 * Time: 7:16 PM
 */
require_once 'vendor/autoload.php';
#Higher Order Messaging
seed_users()->each->addToUserGroup();
seed_users()->every->sendEmail('title', 'content');
seed_users()->filter->isVip()->each->sendEmailInvite();
seed_users()->filter->isPaidUser()->each->sendThankYou();
