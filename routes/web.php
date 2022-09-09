<?php

Route::fallback(function () {
    return view('errors.404');
});

Route::get('clear', function () {
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
});



Route::get('/cron', 'CronController@cron');
Route::get('/coinrate', 'CronController@coinrate');
Route::get('/walletusd', 'CronController@walletusd');

Route::post('ipn/g101', 'Gateway\g101\ProcessController@ipn')->name('ipn.g101'); // paypal
Route::post('ipn/g102', 'Gateway\g102\ProcessController@ipn')->name('ipn.g102'); // Perfect Money
Route::post('ipn/g103', 'Gateway\g103\ProcessController@ipn')->name('ipn.g103'); // Stripe
Route::post('ipn/g104', 'Gateway\g104\ProcessController@ipn')->name('ipn.g104'); // Skrill
Route::post('ipn/g105', 'Gateway\g105\ProcessController@ipn')->name('ipn.g105'); // PayTM
Route::post('ipn/g106', 'Gateway\g106\ProcessController@ipn')->name('ipn.g106'); // Payeer
Route::post('ipn/g107', 'Gateway\g107\ProcessController@ipn')->name('ipn.g107'); // PayStack
Route::post('ipn/g108', 'Gateway\g108\ProcessController@ipn')->name('ipn.g108'); // VoguePay
Route::get('ipn/g109/{trx}/{type}', 'Gateway\g109\ProcessController@ipn')->name('ipn.g109'); //flutterwave

Route::post('ipn/g110', 'Gateway\g110\ProcessController@ipn')->name('ipn.g110'); // RozarPay
Route::post('ipn/g111', 'Gateway\g111\ProcessController@ipn')->name('ipn.g111'); // stripeJs
Route::post('ipn/g112', 'Gateway\g112\ProcessController@ipn')->name('ipn.g112'); //instamojo
Route::post('ipn/g113', 'Gateway\g113\ProcessController@ipn')->name('ipn.g113'); // 2checkout


Route::get('ipn/g501', 'Gateway\g501\ProcessController@ipn')->name('ipn.g501'); // Blockchain
Route::get('ipn/g502', 'Gateway\g502\ProcessController@ipn')->name('ipn.g502'); // Block.io
Route::post('ipn/g503', 'Gateway\g503\ProcessController@ipn')->name('ipn.g503'); // CoinPayment
Route::post('ipn/g504', 'Gateway\g504\ProcessController@ipn')->name('ipn.g504'); // CoinPayment ALL
Route::post('ipn/g505', 'Gateway\g505\ProcessController@ipn')->name('ipn.g505'); // Coingate
Route::post('ipn/g506', 'Gateway\g506\ProcessController@ipn')->name('ipn.g506'); // Coinbase commerce


Route::get('/', 'SiteController@home')->name('home');
Route::get('/change-lang/{lang}', 'SiteController@changeLang')->name('lang');


Route::post('/planCalculator', 'SiteController@planCalculator')->name('planCalculator');

Route::name('home.')->group(function () {
    Route::get('/faq', 'SiteController@faq')->name('faq');
    Route::get('/rules', 'SiteController@rules')->name('rules');
    Route::get('/info/{id}/{slug?}', 'SiteController@policyInfo')->name('policy');
    Route::get('/about', 'SiteController@about')->name('about');

    Route::get('/contact', 'SiteController@contact')->name('contact');
    Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');

    Route::get('/blog', 'SiteController@blog')->name('blog');
    Route::get('/blog/details/{slug?}/{id?}', 'SiteController@blogDetails')->name('blog.details');
    Route::get('/plan', 'SiteController@plan')->name('plan');

    Route::post('/subscribe', 'SiteController@subscribe')->name('subscribe');
});


Route::group(['middleware' => ['guest']], function () {
    Route::get('/register/{reference}', 'SiteController@register')->name('refer.register');
});

Route::get('/reset-password/{token}','Auth\ForgotPassword@sent_link')->middleware(['guest'])->name('password.reset');

Route::post('/reset-password/{token}','PageController@reset')->middleware(['guest'])->name('password.reset.save');





Route::name('user.')->prefix('user')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logoutGet')->name('logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');

    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');


        Route::middleware('ckstatus')->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');

            Route::get('darkmode', 'UserController@darkmode')->name('darkmode');
            Route::get('lightmode', 'UserController@lightmode')->name('lightmode');

            Route::get('edit-profile', 'UserController@editProfile')->name('edit-profile');
            Route::get('my-profile', 'UserController@myProfile')->name('my-profile');
            Route::post('edit-profile', 'UserController@submitProfile');

            Route::get('change-password', 'UserController@changePassword')->name('change-password');
            Route::post('change-password', 'UserController@submitPassword');

            // 2FA
            Route::get('security/two/step', 'UserController@twoFactorAuth')->name('twoFA');
            Route::post('g2fa-create', 'UserController@create2fa')->name('go2fa.create');
            Route::post('g2fa-disable', 'UserController@disable2fa')->name('disable.2fa');

            //Session LOG
            Route::get('security/session-log', 'UserController@sessionlog')->name('sessionlog');
            Route::get('security/session-log-clear', 'UserController@clearsession')->name('clearsession');

            //Blockchain Wallet
            Route::get('wallet/{id}','WalletController@wallet')->name('wallet');
            Route::post('create/wallet/{id}','WalletController@createwallet')->name('createwallet');
            Route::post('create/sendfromwallet/{id}','WalletController@sendfromwallet')->name('sendfromwallet');
            Route::get('view/wallet/{id}','WalletController@viewwallet')->name('viewwallet');


            //Market Offers
            Route::get('create-offer','OfferController@create')->name('createoffer');
            Route::get('create-offer-step2/{id}','OfferController@createoffer2')->name('createoffer2');
            Route::post('post-offer/{id}','OfferController@postoffer')->name('postoffer');
            Route::get('my-offers','OfferController@myoffers')->name('myoffers');
            Route::get('delete-offers/{id}','OfferController@deleteoffer')->name('deleteoffer');
            Route::get('disable-offers/{id}','OfferController@disableoffer')->name('disableoffer');
            Route::get('activate-offers/{id}','OfferController@activateoffer')->name('activateoffer');
            Route::get('manage-offers/{id}','OfferController@manageoffer')->name('manageoffer');
            Route::get('p2p-offers','OfferController@p2p')->name('p2p');
            Route::get('p2p-trades','OfferController@p2plog')->name('p2plog');
            Route::post('p2p-search','OfferController@searchp2p')->name('searchp2p');
            Route::get('market','OfferController@market')->name('market');
            Route::get('view-offer/{id}','OfferController@viewoffer')->name('viewoffer');
            Route::post('contact-seller/{id}','OfferController@contactseller')->name('contactseller');
            Route::get('chat-buyerr','OfferController@chatbuyer')->name('chatbuyer');
            Route::post('reply-buyer','OfferController@replychatbuyer')->name('replychatbuyer');
            Route::get('escrowpaid-seller/{id}','OfferController@escrowpaid')->name('escrowpaid');
            Route::get('chat-seller/{id}','OfferController@chatseller')->name('contactbuyer');
            Route::post('reply-seller','OfferController@replychatseller')->name('replychatseller');
            Route::get('trade-paid/{id}','OfferController@tradepaid')->name('tradepaid');
            Route::get('trade-approve/{id}','OfferController@tradeapprove')->name('tradeapprove');
            Route::get('chat-history/{id}','OfferController@chathistory')->name('chathistory');
            Route::get('trade-dispute/{id}','OfferController@tradedispute')->name('tradedispute');
            Route::get('close-dispute/{id}','OfferController@closedispute')->name('closedispute');

            //Trade
            Route::get('currency/buy', 'TradeController@buy')->name('buy');
            Route::post('currency/buy-coin', 'TradeController@buycoin')->name('buycoin');
            Route::get('currency/sell', 'TradeController@sell')->name('sell');
            Route::post('currency/sell-coin', 'TradeController@sellcoin')->name('sellcoin');
            Route::get('currency/send-currency', 'TradeController@sendcoin')->name('sendcoin');
            Route::post('currency/validate-sell', 'TradeController@validatesell')->name('validatesell');


            // User Support Ticket
            Route::get('supportTicket', 'UserController@supportTicket')->name('ticket');
            Route::get('openSupportTicket', 'UserController@openSupportTicket')->name('ticket.open');
            Route::post('openSupportTicket', 'UserController@storeSupportTicket')->name('ticket.store');
            Route::get('supportMessage/{ticket}', 'UserController@supportMessage')->name('message');
            Route::put('storeSupportMessage/{ticket}', 'UserController@supportMessageStore')->name('message.store');
            Route::get('ticketDownload/{ticket}', 'UserController@ticketDownload')->name('ticket.download');
            Route::post('ticketDelete', 'UserController@ticketDelete')->name('ticket.delete');


            // Deposit
            Route::get('deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit-insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
            Route::get('deposit-preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');
            Route::get('deposit-confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');

            Route::get('manual/deposit-preview', 'Gateway\PaymentController@manualDepositPreview')->name('manualDeposit.preview');
            Route::get('manual/deposit', 'Gateway\PaymentController@manualDepositConfirm')->name('manualDeposit.confirm');
            Route::post('manual/deposit', 'Gateway\PaymentController@manualDepositUpdate')->name('manualDeposit.update');
            Route::get('deposit/history', 'UserController@depositHistory')->name('deposit.history');

            // Withdraw
            Route::get('/withdraw-money', 'UserController@withdrawMoney')->name('withdraw.money');
            Route::post('/withdraw-money', 'UserController@withdrawMoneyRequest')->name('withdraw.moneyReq');
            Route::get('/withdraw-preview', 'UserController@withdrawReqPreview')->name('withdraw.preview');
            Route::post('/withdraw-preview', 'UserController@withdrawReqSubmit')->name('withdraw.submit');
            Route::get('/withdraw-log', 'UserController@withdrawLog')->name('withdrawLog');

            // Transaction
            Route::get('transactions', 'UserController@transactions')->name('transactions');
            Route::get('interest/log', 'UserController@interestLog')->name('interest.log');

            Route::get('referral', 'UserController@refMy')->name('referral');

            Route::get('/vault-plan', 'UserController@plan')->name('vault');
            Route::post('/plans', 'UserController@buyPlan')->name('buy.plan');
            
            // KYC
            Route::get('verification/kyc', 'UserController@kyc')->name('kyc');
            Route::post('verification/kyc', 'UserController@postkyc')->name('kycpost');
        });
    });
});



Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');


        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        //refer
        Route::get('/referral', 'AdminController@refIndex')->name('referral.index');
        Route::post('/referral', 'AdminController@refStore')->name('store.refer');

        // General Setting
        Route::get('setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('setting', 'GeneralSettingController@update')->name('setting.update');


        //Currency Setting
        Route::get('currency_setting', 'CurrencySettingController@index')->name('currency.index');
        Route::get('currency_activate/{id}', 'CurrencySettingController@activate')->name('currency.activate');
        Route::get('currency_deactivate/{id}', 'CurrencySettingController@deactivate')->name('currency.deactivate');
        Route::get('currency_setting/{id}', 'CurrencySettingController@edit')->name('currency.edit');
        Route::get('currency_edit/{id}', 'CurrencySettingController@edit')->name('currency.edit');
        Route::post('currency_api/{id}', 'CurrencySettingController@apiupdate')->name('updatecurrencyapi');
        Route::post('currency_update/{id}', 'CurrencySettingController@updatecurrency')->name('updatecurrency');

        //Wallet Settings
        Route::get('wallet_setting', 'WalletSettingController@index')->name('wallet.index');
        Route::get('wallet_view/{id}', 'WalletSettingController@viewwallet')->name('wallet.view');
        Route::get('deactivatewallet/{id}', 'WalletSettingController@deactivatewallet')->name('deactivatewallet');
        Route::get('activatewallet/{id}', 'WalletSettingController@activatewallet')->name('activatewallet');
        Route::post('creditwallet/{id}', 'WalletSettingController@creditwallet')->name('creditwallet');
        Route::post('debitwallet/{id}', 'WalletSettingController@debitwallet')->name('debitwallet');
        Route::post('createwallet/{id}', 'WalletSettingController@createwallet')->name('createwallet');
        Route::get('view_wallet/{id}', 'WalletSettingController@viewwalletaddress')->name('viewwallet');
        Route::get('wallet_sent', 'WalletSettingController@sent')->name('wallet.sent');
        Route::get('wallet_sent_view/{id}', 'WalletSettingController@sentview')->name('wallet.sentview');
        Route::get('wallet_receive', 'WalletSettingController@receive')->name('wallet.receive');
        Route::get('wallet_sreceive_view/{id}', 'WalletSettingController@receiveview')->name('wallet.receiveview');
        Route::get('wallet_all', 'WalletSettingController@alltrx')->name('wallet.all');
        Route::get('wallet_alltrx_view/{id}', 'WalletSettingController@alltrxview')->name('wallet.alltrx');


        //Trade Controller
        Route::get('succesful_buy', 'TradeSettingController@successfulbuy')->name('successful.buy');
        Route::get('pending_buy', 'TradeSettingController@pendingbuy')->name('pending.buy');
        Route::get('declined_buy', 'TradeSettingController@declinedbuy')->name('declined.buy');
        Route::get('approvebuy/{id}', 'TradeSettingController@approvebuy')->name('approve.buy');
        Route::get('declinedbuy/{id}', 'TradeSettingController@declinebuy')->name('decline.buy');
        Route::get('view_buy/{id}', 'TradeSettingController@viewbuy')->name('view.buy');
        Route::get('succesful_sell', 'TradeSettingController@successfulsell')->name('successful.sell');
        Route::get('pending_sell', 'TradeSettingController@pendingsell')->name('pending.sell');
        Route::get('declined_sell', 'TradeSettingController@declinedsell')->name('declined.sell');
        Route::get('approvesell/{id}', 'TradeSettingController@approvesell')->name('approve.sell');
        Route::get('declinedsell/{id}', 'TradeSettingController@declinesell')->name('decline.sell');
        Route::get('view_sell/{id}', 'TradeSettingController@viewsell')->name('view.sell');
        Route::get('validate_sell/{id}', 'TradeSettingController@validatesell')->name('validate.sell');

        //Offer Controller
        Route::get('offer_all', 'OfferSettingController@alloffer')->name('all.offer');
        Route::get('offer_view/{id}', 'OfferSettingController@viewoffer')->name('view.offer');
        Route::get('trade_all/{id}', 'OfferSettingController@alltrade')->name('alltrx.offer');
        Route::get('trade_success/{id}', 'OfferSettingController@successtrade')->name('success.offer');
        Route::get('trade_pending/{id}', 'OfferSettingController@pendingtrade')->name('pending.offer');
        Route::get('trade_dispute/{id}', 'OfferSettingController@disputetrade')->name('dispute.offer');
        Route::get('trade_paid/{id}', 'OfferSettingController@paidrade')->name('paid.offer');
        Route::get('trade_disputed/{id}', 'OfferSettingController@disputedtrade')->name('disputed.offer');
        Route::get('trade_pending/{id}', 'OfferSettingController@pendingtrade')->name('pending.offer');
        Route::get('trade_successful/{id}', 'OfferSettingController@successfultrade')->name('success.offer');
        Route::get('trade_paid/{id}', 'OfferSettingController@paidtrade')->name('paid.offer');
        Route::get('trade_approve/{id}', 'OfferSettingController@tradeapprove')->name('tradeapprove');
        Route::get('trade_cancel_dispute/{id}', 'OfferSettingController@canceldispute')->name('canceldispute');
        Route::get('trade-delete/{id}','OfferSettingController@tradedelete')->name('tradedelete');
        Route::get('trade_chat/{id}', 'OfferSettingController@tradechat')->name('tradechat');
        Route::get('deactivateoffer/{id}', 'OfferSettingController@deactivateoffer')->name('deactivate.offer');
        Route::get('activateoffer/{id}', 'OfferSettingController@activateoffer')->name('activate.offer');
        Route::get('successfuloffer', 'OfferSettingController@successfulc')->name('successful.offer');
        Route::get('awaiting_offer_view/{id}', 'OfferSettingController@awaitingofferview')->name('view.awaiting.offer');
        Route::get('escrowcheck/{id}', 'OfferSettingController@escrowcheck')->name('escrowcheck');
        Route::get('awaitingoffer', 'OfferSettingController@awaiting')->name('awaiting.offer');
        Route::get('successful_offer_view/{id}', 'OfferSettingController@successfulofferview')->name('view.successful.offer');
        Route::get('pendingoffer', 'OfferSettingController@pendingc')->name('pending.offer');
        Route::get('pending_offer_view/{id}', 'OfferSettingController@pendingofferview')->name('view.pending.offer');
        Route::get('declinedoffer', 'OfferSettingController@declinedc')->name('declined.offer');
        Route::get('disputed_offer_view/{id}', 'OfferSettingController@declinedofferview')->name('view.declined.offer');

        // Language Manager
        Route::get('setting/language/manager', 'LanguageController@langManage')->name('setting.language-manage');
        Route::post('setting/language/manager', 'LanguageController@langStore')->name('setting.language-manage-store');
        Route::delete('setting/language-manage/{id}', 'LanguageController@langDel')->name('setting.language-manage-del');
        Route::get('setting/language-key/{id}', 'LanguageController@langEdit')->name('setting.language-key');
        Route::put('setting/key-update/{id}', 'LanguageController@langUpdate')->name('setting.key-update');
        Route::post('setting/language-manage-update/{id}', 'LanguageController@langUpdatepp')->name('setting.language-manage-update');
        Route::post('setting/language-import', 'LanguageController@langImport')->name('setting.import_lang');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo-icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo-icon');




        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email-template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email-template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email-template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email-template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email-template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email-template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email-template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email-template.sendTestMail');

        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms-template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms-template.global');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms-template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms-template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('email-template.sendTestSMS');

        // Plugin
        Route::get('plugin', 'PluginController@index')->name('plugin.index');
        Route::post('plugin/update/{id}', 'PluginController@update')->name('plugin.update');
        Route::post('plugin/activate', 'PluginController@activate')->name('plugin.activate');
        Route::post('plugin/deactivate', 'PluginController@deactivate')->name('plugin.deactivate');

        // Users Manager
        Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');
        Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
        Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.all');
        Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
        Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
        Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');

        // Login History
        Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');
        Route::get('users/login/history', 'ManageUsersController@loginHistory')->name('users.login.history');

        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');
        
         // KYC Setting
        Route::get('pending-kyc', 'ManageUsersController@pkyc')->name('pkyc');
        Route::get('verified-kyc', 'ManageUsersController@akyc')->name('vkyc');
        Route::get('declined-kyc', 'ManageUsersController@dkyc')->name('dkyc');
        Route::get('view-kyc/{id}', 'ManageUsersController@viewkyc')->name('viewkyc');
        Route::get('verify-kyc/{id}', 'ManageUsersController@verifykyc')->name('verifykyc');
        Route::get('decline-kyc/{id}', 'ManageUsersController@declinekyc')->name('declinekyc');


        // WITHDRAW SYSTEM
        Route::get('withdraw/pending', 'WithdrawalController@pending')->name('withdraw.pending');
        Route::get('withdraw/approved', 'WithdrawalController@approved')->name('withdraw.approved');
        Route::get('withdraw/rejected', 'WithdrawalController@rejected')->name('withdraw.rejected');
        Route::get('withdraw/log', 'WithdrawalController@log')->name('withdraw.log');
        Route::get('withdraw/{scope}/search', 'WithdrawalController@search')->name('withdraw.search');
        Route::post('withdraw/approve', 'WithdrawalController@approve')->name('withdraw.approve');
        Route::post('withdraw/reject', 'WithdrawalController@reject')->name('withdraw.reject');

        // Withdraw Method
        Route::get('withdraw/method/', 'WithdrawMethodController@methods')->name('withdraw.method.methods');
        Route::get('withdraw/method/new', 'WithdrawMethodController@create')->name('withdraw.method.create');
        Route::post('withdraw/method/store', 'WithdrawMethodController@store')->name('withdraw.method.store');
        Route::get('withdraw/method/edit/{id}', 'WithdrawMethodController@edit')->name('withdraw.method.edit');
        Route::post('withdraw/method/edit/{id}', 'WithdrawMethodController@update')->name('withdraw.method.update');
        Route::post('withdraw/method/activate', 'WithdrawMethodController@activate')->name('withdraw.method.activate');
        Route::post('withdraw/method/deactivate', 'WithdrawMethodController@deactivate')->name('withdraw.method.deactivate');

        // DEPOSIT SYSTEM
        Route::get('deposit', 'DepositController@deposit')->name('deposit.list');
        Route::get('deposit/pending', 'DepositController@pending')->name('deposit.pending');
        Route::get('deposit/rejected', 'DepositController@rejected')->name('deposit.rejected');
        Route::get('deposit/approved', 'DepositController@approved')->name('deposit.approved');
        Route::post('deposit/reject', 'DepositController@reject')->name('deposit.reject');
        Route::post('deposit/approve', 'DepositController@approve')->name('deposit.approve');
        Route::get('deposit/{scope}/search', 'DepositController@search')->name('deposit.search');

        // Manual Methods
        Route::get('deposit/manual-methods', 'ManualGatewayController@index')->name('deposit.manual.index');
        Route::get('deposit/manual-methods/new', 'ManualGatewayController@create')->name('deposit.manual.create');
        Route::post('deposit/manual-methods/new', 'ManualGatewayController@store')->name('deposit.manual.store');
        Route::get('deposit/manual-methods/edit/{id}', 'ManualGatewayController@edit')->name('deposit.manual.edit');
        Route::post('deposit/manual-methods/update/{id}', 'ManualGatewayController@update')->name('deposit.manual.update');
        Route::post('deposit/manual-methods/activate', 'ManualGatewayController@activate')->name('deposit.manual.activate');
        Route::post('deposit/manual-methods/deactivate', 'ManualGatewayController@deactivate')->name('deposit.manual.deactivate');

        // Deposit Gateway
        Route::get('deposit/gateway', 'GatewayController@index')->name('deposit.gateway.index');
        Route::get('deposit/gateway/edit/{code}', 'GatewayController@edit')->name('deposit.gateway.edit');
        Route::post('deposit/gateway/update/{code}', 'GatewayController@update')->name('deposit.gateway.update');
        Route::post('deposit/gateway/remove/{code}', 'GatewayController@remove')->name('deposit.gateway.remove');
        Route::post('deposit/gateway/activate', 'GatewayController@activate')->name('deposit.gateway.activate');
        Route::post('deposit/gateway/deactivate', 'GatewayController@deactivate')->name('deposit.gateway.deactivate');

        // Report
        Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');


        // Admin Support
        Route::get('tickets-list', 'DashboardController@supportTicket')->name('ticket');
        Route::get('tickets-reply/{id}', 'DashboardController@ticketReply')->name('ticket.reply');
        Route::get('tickets-open', 'DashboardController@openSupportTicket')->name('open.ticket');
        Route::get('tickets-pending', 'DashboardController@pendingSupportTicket')->name('pending.ticket');
        Route::get('tickets-closed', 'DashboardController@closedSupportTicket')->name('closed.ticket');
        Route::put('ticketReplySend/{id}', 'DashboardController@ticketReplySend')->name('ticket.send');
        Route::get('ticketDownload/{ticket}', 'DashboardController@ticketDownload')->name('ticket.download');
        Route::post('ticketDelete', 'DashboardController@ticketDelete')->name('ticket.delete');


        // Contact Topic
        Route::get('contact-topic', 'ContactTopicController@index')->name('contact-topic');
        Route::get('contact-topic/data', 'ContactTopicController@getTopic')->name('get-topic');
        Route::post('contact-topic/store', 'ContactTopicController@storeTopic')->name('store.contact-topic');
        Route::post('contact-topic/update', 'ContactTopicController@updateTopic')->name('update.contact-topic');
        Route::post('contact-topic/delete', 'ContactTopicController@destroyTopic')->name('delete.contact-topic');



        // Time & Plan Controller
        Route::get('time-setting', 'TimeSettingController@index')->name('time-setting');
        Route::post('time-store', 'TimeSettingController@store')->name('time-store');
        Route::put('time-setting/{id}', 'TimeSettingController@update')->name('time-update');
        Route::delete('time-setting/{id}', 'TimeSettingController@destroy')->name('time-destroy');


        Route::get('plan-setting', 'PlanController@index')->name('plan-setting');
        Route::get('plan-setting/edit/{id}', 'PlanController@edit')->name('plan-edit');
        Route::get('plan-setting/create', 'PlanController@create')->name('plan-create');
        Route::post('plan-setting/create', 'PlanController@store')->name('plan-store');
        Route::put('plan-setting/update/{id}', 'PlanController@update')->name('plan-update');


        Route::get('running-plan', 'PlanController@running')->name('plan-running');
        Route::get('closed-plan', 'PlanController@closed')->name('plan-closed');





        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {
            Route::post('store', 'FrontendController@store')->name('store');
            Route::post('remove', 'FrontendController@remove')->name('remove');
            Route::post('{id}/update', 'FrontendController@update')->name('update');

            // Blog
            Route::get('blog/', 'FrontendController@blogIndex')->name('blog.index');
            Route::get('blog/edit/{id}/{slug}', 'FrontendController@blogEdit')->name('blog.edit');
            Route::get('blog/new', 'FrontendController@blogNew')->name('blog.new');

            // SEO
            Route::get('seo', 'FrontendController@seoEdit')->name('seo.edit');

            // Social
            Route::get('social', 'FrontendController@socialIndex')->name('social.index');

            // Testimonial
            Route::get('testimonial', 'FrontendController@testimonialIndex')->name('testimonial.index');
            Route::get('testimonial/new', 'FrontendController@testimonialNew')->name('testimonial.new');
            Route::get('testimonial/edit/{id}', 'FrontendController@testimonialEdit')->name('testimonial.edit');

            // FAQ
            Route::get('faq', 'FrontendController@faqIndex')->name('faq.index');
            Route::get('faq/{id}/{slug}/edit', 'FrontendController@faqEdit')->name('faq.edit');
            Route::get('faq/new', 'FrontendController@faqNew')->name('faq.new');

            // RULE
            Route::get('rules', 'FrontendController@ruleIndex')->name('rules.index');
            Route::get('rules/{id}/edit', 'FrontendController@ruleEdit')->name('rules.edit');
            Route::get('rules/new', 'FrontendController@ruleNew')->name('rules.new');

            // Company policy
            Route::get('company_policy/', 'FrontendController@companyPolicy')->name('companyPolicy.index');
            Route::get('company_policy/{id}/{slug}/edit', 'FrontendController@companyPolicyEdit')->name('companyPolicy.edit');
            Route::get('company_policy/new', 'FrontendController@companyPolicyNew')->name('companyPolicy.new');


            // Manage About
            Route::get('about', 'FrontendController@sectionAbout')->name('about.edit');
            Route::post('about/{id}/update', 'FrontendController@sectionAboutUpdate')->name('about.update');

            // Manage About
            Route::get('homeContent', 'FrontendController@sectionHomeContent')->name('homeContent.edit');
            Route::post('homeContent/{id}/update', 'FrontendController@sectionHomeContentUpdate')->name('homeContent.update');



            // services
            Route::get('services', 'FrontendController@servicesIndex')->name('services.index');
            Route::get('services/new', 'FrontendController@servicesNew')->name('services.new');
            Route::get('services/edit/{id}', 'FrontendController@servicesEdit')->name('services.edit');

            // services
            Route::get('howToGetProfit', 'FrontendController@profitIndex')->name('profit.index');
            Route::get('howToGetProfit/new', 'FrontendController@profitNew')->name('profit.new');
            Route::get('howToGetProfit/edit/{id?}', 'FrontendController@profitEdit')->name('profit.edit');

            // services
            Route::get('feature', 'FrontendController@featureIndex')->name('feature.index');
            Route::get('feature/new', 'FrontendController@featureNew')->name('feature.new');
            Route::get('feature/edit/{id?}', 'FrontendController@featureEdit')->name('feature.edit');


            Route::get('breadcrumb-icon', 'FrontendController@logoIcon')->name('breadcrumb.logo-icon');
            Route::post('breadcrumb-icon', 'FrontendController@logoIconUpdate')->name('breadcrumb.logo-icon');




            Route::get('contact', 'FrontendController@sectionContact')->name('section.contact.edit');


        });
    });
});
