@extends('layouts.emails.master')

@section('title', '| Mail')

@section('subject')
  Mail from an iPub account user
@endsection

@section('description')
  {!! $subject !!}
@endsection

@section('body')
  <tr>
    <td class="innerpadding borderbottom">
      <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="115" style="padding: 0 20px 20px 0;">
            <img src="{{ url('/profile-picture') }}" width="115" height="115" border="0" alt="{{ Auth::user()->name }}" />
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
                  {!! $body !!}
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
