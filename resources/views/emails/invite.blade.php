@extends('layouts.emails.master')

@section('title', '| Invitation')

@section('subject')
  Invitation to rate pubs on iPub
@endsection

@section('description')
  <a href="{{ url('/pubs/'.Auth::user()->name.'/'.Auth::user()->id) }}" style = "text-decoration: none; color: #72afd2"><b>{{ Auth::user()->name }}</b></a> is requesting you to rate its pubs on <a href="{{ url('/') }}" style = "text-decoration: none; color: #72afd2"><b>iPub</b></a>
@endsection

@section('body')
  <tr>
    <td class="innerpadding borderbottom">
      <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="115" style="padding: 0 20px 20px 0;">
            <img src="{{ $message->embedData($profilePicture, 'profile picture') }}" width="115" height="115" border="0" alt="{{ Auth::user()->name }}" />
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
        <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
      <![endif]-->
      <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="bodycopy">
                  By accepting this request: <br /><br />
                  An iPub Rater account will be created with your email if you do not already have one. <br /><br />
                  You will only be able to rate pubs on iPub when you are in Rating mode. <br /><br />
                  You will be able to rate any pub, not only pubs created by {{ Auth::user()->name }}
                </td>
              </tr>
              <tr>
                <td style="padding: 20px 0 0 0;">
                  <table class="buttonwrapper" bgcolor="#3c8dbc" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="button" height="45">
                        <a href="{{ url('/invitation/accept/'.Auth::user()->id.'/'.$email) }}">Accept</a>
                      </td>
                    </tr>
                  </table>
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
  <!--<tr>
    <td class="innerpadding borderbottom">
      <img src="ipub/dist/img/ipub.png" width="100%" border="0" alt="" />
    </td>
  </tr>-->
@endsection
