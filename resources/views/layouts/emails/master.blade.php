<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <!-- favicon -->
    <link rel = "shortcut icon" href = "{{ asset('favicon.ico') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iPub @yield('title')</title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
        @media only screen and (min-device-width: 601px) {
          .content {width: 600px !important; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
        }

        .heading {padding: 40px 30px 20px 30px;}
        .col425 {width: 425px!important;}
        .subhead {font-size: 15px; color: #ffffff; letter-spacing: 4px;}
        .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
        .h1, .h2, .bodycopy {color: #153643;}
        .innerpadding {padding: 30px 30px 30px 30px;}
        .borderbottom {border-bottom: 1px solid #f2eeed;}
        .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
        .bodycopy {font-size: 16px; line-height: 22px;}
        .button {text-align: center; font-size: 18px; font-weight: bold; padding: 0 30px 0 30px;}
        .button a {color: #ffffff; text-decoration: none;}
        @media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
        }
        a {color: #72afd2}
        img {height: auto;}
        .footer {padding: 20px 30px 15px 30px; color: #444444; border-top: 1px solid #d2d6de;}
        .footercopy {font-size: 14px;}
        .footercopy a {color: #72afd2; text-decoration: none;}
        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
          body[yahoo] .buttonwrapper {background-color: transparent!important;}
          body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important; display: block!important;}
        }
    </style>
  </head>
  <body yahoo bgcolor = "#f0f3f6">
    <table width = "100%" bgcolor = "#f0f3f6" border = "0" cellpadding = "0" cellspacing = "0">
      <tr>
        <td>
          <!--[if (gte mso 9)|(IE)]>
          <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
                <![endif]-->
                  <table class = "content" align = "center" cellpadding = "0" cellspacing = "0" border = "0">
                    <tr>
                      <td class = "header" bgcolor = "#3c8dbc">
                        <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="70" style="padding: 0 20px 20px 0; font-size:45px; font-weight: 300;">
                              <a href="{{ url('/') }}" style = "padding: 0 5px 0 5px; text-decoration: none; color: #ffffff; background-color: #367fa9; border-bottom: 0 solid transparent;"><b style = "font-weight: 700">iP</b>ub</a>
                            </td>
                            <td>
                              <!--[if (gte mso 9)|(IE)]>
                              <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                  <td>
                                    <![endif]-->
                                      <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 425px;">
                                        <tr>
                                          <td height="70">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="subhead" style="padding: 0 0 0 3px;">
                                                  AN
                                                </td>
                                              </tr>
                                              <tr>
                                                <td class="h1" style="padding: 5px 0 0 0; color: #ffffff">
                                                  Internet Publicity Platform
                                                </td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                  </td>
                                </tr>
                              </table>
                              <![endif]-->
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td class="innerpadding borderbottom">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="h2">
                              @yield('subject')
                            </td>
                          </tr>
                          <tr>
                            <td class="bodycopy">
                              @yield('description')
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    @yield('body')
                    <tr>
                      <td class="footer" bgcolor="#ffffff">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" class="footercopy">
                              <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">iPub.com</a></strong> . All rights reserved.
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </body>
</html>
