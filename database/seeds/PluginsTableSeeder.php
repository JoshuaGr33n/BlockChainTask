<?php

use Illuminate\Database\Seeder;

class PluginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plugins')->insert([
            [
                'act' => 'google-analytics',
                'name' => 'Google Analytics',
                'image' => 'google-analytics.png',
                'description' => 'Key location is shown bellow',
                'support' => 'ganalytics.png',
                'script' => '<script async src="https://www.googletagmanager.com/gtag/js?id={{app_key}}"></script>
                <script>
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag("js", new Date());
                
                  gtag("config", "{{app_key}}");
                </script>',
                'shortcode' => json_encode([
                    'app_key' => [
                        'title' => 'App Key',
                        'value' => 'Demo'
                    ],
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'act' => 'tawk-chat',
                'name' => 'Tawk Chat',
                'image' => 'tawky_big.png',
                'description' => 'Key location is shown bellow',
                'support' => 'twak.png',
                'script' => '<script>
                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                        (function(){
                        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                        s1.async=true;
                        s1.src="https://embed.tawk.to/{{app_key}}/default";
                        s1.charset="UTF-8";
                        s1.setAttribute("crossorigin","*");
                        s0.parentNode.insertBefore(s1,s0);
                        })();
                    </script>',
                'shortcode' => json_encode([
                    'app_key' => [
                        'title' => 'App Key',
                        'value' => 'Demo'
                    ],
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'act' => 'google-recaptcha3',
                'name' => 'Google Recaptch 3',
                'image' => 'recaptcha3.png',
                'description' => 'Key location is shown bellow',
                'support' => 'recaptcha.png',
                'script' => '<script type="text/javascript">

                            var onloadCallback = function() {
                                grecaptcha.render("recaptcha", {
                                    "sitekey" : "{{sitekey}}",
                                    "callback": function(token) {
                                        $("#recaptcha").parents("form:first").submit();
                                    } 
                                });
                            };
                        </script>
                        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>',
                'shortcode' => json_encode([
                    'sitekey' => [
                        'title' => 'Site Key',
                        'value' => '6Ldy8bUUAAAAALn0JWsmdKYvOBuL18qExf1PczsJ'
                    ],
                ]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
