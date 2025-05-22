<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function qrCode()
{
    $profileText = <<<EOT
QR code details

Name: মোঃ মাহবুবুল আলম রিপন
Father's Name: মৃত মোঃ খোরশীদ আলম (বীরমুক্তিযোদ্ধা)
Mother's Name: মাফরুজা আক্তার
Village: শ্রীরামপুর
Post Office: কালামপুর
Upazila: ধামরাই, ঢাকা।
Date of Birth: ০৬/০৬/১৯৮৫ ইং
Blood Group: A+
NID No: 418 005 1361
Tin No: 116838253890
Cell No: 01711346953, 01511346953
Email: ripon.dae13@gmail.com, ripon.agriofficer@gmail.com
Designation: উপ-সহকারী কৃষি কর্মকর্তা, কৃষি সম্প্রসারণ অধিদপ্তর, কৃষি মন্ত্রণালয়
যোগদানের তারিখ: ১২/০৮/২০১৩ ইং
Facebook ID: https://www.facebook.com/mar.mahbubul.ripon

Photo: {{ url('images/ripon.jpg') }}
EOT;

    $qrCode = QrCode::encoding('UTF-8')
        ->errorCorrection('H')
        ->size(300)
        ->margin(1)
        ->generate($profileText);

    $imageUrl = asset('images/ripon.jpg'); // ✅ Add this line

    return view('qr_code', compact('qrCode', 'imageUrl')); // ✅ Pass $imageUrl
}

}