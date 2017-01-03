<?php if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options

return [
  // Captcha configuration for login page
  'LoginCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 6),
    'ImageStyle' => [
      ImageStyle::Radar,
      ImageStyle::Collage,
      ImageStyle::Fingerprints,
    ],
  ],

  // Captcha configuration for register page
  'RegisterCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 7),
    'CodeStyle' => CodeStyle::Alpha,
  ],

  // Captcha configuration for reset password page
  'ResetPasswordCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'CodeLength' => CaptchaRandomization::GetRandomCodeLength(3, 6),
    'CustomLightColor' => '#9966FF',
  ],

];
