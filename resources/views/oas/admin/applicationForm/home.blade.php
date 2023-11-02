<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <style type="text/css">
        .course_pf {
            position: absolute;
            left: 112px;
            top: 284px;
            font-size: 20px;
            width: 25px;
        }
        .course_pp {
            position: absolute;
            left: 112px;
            top: 313px;
            font-size: 20px;
            width: 25px;
        }
        
        .course_mf {
            position: absolute;
            left: 319px;
            top: 284px;
            font-size: 20px;
            width: 25px;
        }
        
        .course_mp {
            position: absolute;
            left: 319px;
            top: 313px;
            font-size: 20px;
            width: 25px;
        }
        
        .course_qb {
            position: absolute;
            left: 403px;
            top: 288px;
            font-size: 20px;
            width: 25px;
            display: none;
        }
        
        .course_b {
            position: absolute;
            left: 455px;
            top: 292px;
            font-size: 20px;
            width: 25px;
        }
        .course_d {
            position: absolute;
            left: 652px;
            top: 291px;
            font-size: 20px;
            width: 25px;
        }
        
        .course_f {
            position: absolute;
            left: 806px;
            top: 291px;
            font-size: 20px;
            width: 25px;
        }
        
        .container {
            position: relative;
        }
        
        .student_type1 {
            position: absolute;
            left: 31px;
            top: 183px;
            font-size: 20px;
            width: 35px;
            display: none;
        }
        .student_type2 {
            position: absolute;
            left: 32px;
            top: 207px;
            font-size: 20px;
            width: 35px;
            display: none;
        }
        
        .intake_month {
            position: absolute;
            left: 94px;
            top: 216px;
            font-size: 20px;
        }
        
        .photo {
            position: absolute;
            left: 817px;
            top: 91px;
            width: 123px;
            text-align: center;
            background-color: #FFF;
            height: 153px;
        }
        .photo img {
            border: 1px solid #CCC;
            max-width: 123px;
            max-height: 153px;
        }
        
        .intake_year {
            position: absolute;
            left: 158px;
            top: 216px;
            font-size: 20px;
        }
        .programme1 {
            position: absolute;
            left: 248px;
            width: 700px;
            overflow: hidden;
            top: 327px;
        }
        .programme2 {
            position: absolute;
            left: 248px;
            width: 700px;
            overflow: hidden;
            top: 363px;
        }
        
        .programme3 {
            position: absolute;
            left: 249px;
            width: 700px;
            overflow: hidden;
            top: 395px;
        }
        
        .ch_name {
            position: absolute;
            left: 574px;
            top: 507px;
            font-size: 20px;
            width: 317px;
        }
        .en_name {
            position: absolute;
            left: 189px;
            top: 506px;
            font-size: 20px;
            width: 371px;
            overflow: hidden;
        }
        
        .ic {
            position: absolute;
            left: 188px;
            top: 546px;
            font-size: 20px;
            width: 317px;
        }
        .race {
            position: absolute;
            left: 187px;
            top: 598px;
            font-size: 20px;
            width: 317px;
        }
        .gender {
            position: absolute;
            left: 641px;
            top: 598px;
            font-size: 20px;
            width: 243px;
        }
        .nationality {
            position: absolute;
            left: 186px;
            top: 641px;
            font-size: 20px;
            width: 317px;
        }
        .place_of_birth {
            position: absolute;
            left: 187px;
            top: 690px;
            font-size: 20px;
            width: 369px;
        }
        .birth_date {
            position: absolute;
            left: 661px;
            top: 688px;
            font-size: 20px;
            width: 168px;
        }
        .religion {
            position: absolute;
            left: 662px;
            top: 642px;
            font-size: 20px;
            width: 317px;
        }
        .age {
            position: absolute;
            left: 156px;
            top: 733px;
            font-size: 20px;
            width: 817px;
        }
        .tel_home {
            position: absolute;
            left: 195px;
            top: 781px;
            font-size: 20px;
            width: 317px;
        }
        .email {
            position: absolute;
            left: 616px;
            top: 780px;
            font-size: 20px;
            width: 346px;
        }
        .c_address {
            position: absolute;
            left: 295px;
            top: 826px;
            font-size: 20px;
            width: 706px;
            line-height: 35px;
        }
        .p_address {
            position: absolute;
            left: 1119px;
            top: 737px;
            font-size: 20px;
            width: 702px;
            line-height: 30px;
        }
        .p_ch_name {
            position: absolute;
            left: 595px;
            top: 942px;
            font-size: 20px;
            width: 266px;
        }
        .p_en_name {
            position: absolute;
            left: 200px;
            top: 943px;
            font-size: 20px;
            width: 389px;
            overflow: hidden;
        }
        .p_ic {
            position: absolute;
            left: 202px;
            top: 997px;
            font-size: 20px;
            width: 296px;
            overflow: hidden;
        }
        .p_income {
            position: absolute;
            left: 206px;
            top: 1046px;
            font-size: 20px;
            width: 291px;
            overflow: hidden;
        }
        .p_relationship {
            position: absolute;
            left: 675px;
            top: 1044px;
            font-size: 20px;
            width: 309px;
            overflow: hidden;
        }
        .p_race {
            position: absolute;
            left: 1236px;
            top: 1200px;
            font-size: 20px;
            width: 291px;
            overflow: hidden;
        }
        .p_religion {
            position: absolute;
            left: 1224px;
            top: 1167px;
            font-size: 20px;
            width: 324px;
            overflow: hidden;
        }
        .p_nationality {
            position: absolute;
            left: 201px;
            top: 1097px;
            font-size: 20px;
            width: 324px;
            overflow: hidden;
        }
        .p_occupation {
            position: absolute;
            left: 676px;
            top: 1098px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .p_tel {
            position: absolute;
            left: 196px;
            top: 1149px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .p_email {
            position: absolute;
            left: 669px;
            top: 1153px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .p_paddress {
            position: absolute;
            left: 1237px;
            top: 1229px;
            font-size: 20px;
            width: 702px;
            line-height: 40px;
        }
        .e_en_name1 {
            position: absolute;
            left: 270px;
            top: -194px;
            font-size: 20px;
            width: 367px;
            overflow: hidden;
        }
        .e_ch_name1 {
            position: absolute;
            left: 646px;
            top: -194px;
            font-size: 20px;
            width: 233px;
            overflow: hidden;
        }
        .e_relationship1 {
            position: absolute;
            left: 270px;
            top: -160px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .e_tel1 {
            position: absolute;
            left: 740px;
            top: -163px;
            font-size: 20px;
            width: 231px;
            overflow: hidden;
        }
        .e_en_name2 {
            position: absolute;
            left: 269px;
            top: -119px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .e_ch_name2 {
            position: absolute;
            left: 583px;
            top: -120px;
            font-size: 20px;
            width: 233px;
            overflow: hidden;
        }
        .e_relationship2 {
            position: absolute;
            left: 269px;
            top: -78px;
            font-size: 20px;
            width: 300px;
            overflow: hidden;
        }
        .e_tel2 {
            position: absolute;
            left: 743px;
            top: -79px;
            font-size: 20px;
            width: 231px;
            overflow: hidden;
        }
        .academic_record {
            position: absolute;
            left: 29px;
            top: 40px;
            font-size: 15px;
            width: 949px;
            overflow: hidden;
            height: 200px;
        }
        .health_status {
            position: absolute;
            left: 499px;
            top: 475px;
            font-size: 20px;
            width: 481px;
            overflow: hidden;
            height: 381px;
        }
        .health_status div {
            overflow: hidden;
            height: 25px;
        }
        .signature1 {
            position: absolute;
            left: 136px;
            top: 1225px;
            font-size: 36px;
            width: 306px;
            overflow: hidden;
            font-family: "Brush Script MT";
        }
        .name1 {
            position: absolute;
            left: 135px;
            top: 1317px;
            font-size: 20px;
            width: 286px;
            overflow: hidden;
        }
        .sd_name {
            position: absolute;
            left: 135px;
            width: 304px;
            top: 820px;
            display: table;
            height: 45px;
            font-size: 20px;
        }
        .sd_name div{
            vertical-align: bottom;
            display: table-cell;
        }
        .guarantee_name {
            position: absolute;
            left: 45px;
            width: 271px;
            top: 315px;
            display: table;
            height: 45px;
            font-size: 20px;
        }
        .guarantee_name div{
            vertical-align: bottom;
            display: table-cell;
        }
        .date1 {
            position: absolute;
            left: 683px;
            top: 805px;
            font-size: 20px;
            width: 156px;
            overflow: hidden;
        }
        .signature2 {
            position: absolute;
            left: 137px;
            top: 561px;
            font-size: 36px;
            width: 306px;
            overflow: hidden;
            font-family: "Brush Script MT";
        }
        .date2 {
            position: absolute;
            left: 688px;
            top: 205px;
            font-size: 20px;
            width: 156px;
            overflow: hidden;
        }
        .name2 {
            position: absolute;
            left: 52px;
            top: 521px;
            font-size: 20px;
            width: 247px;
            overflow: hidden;
        }
        .signature3 {
            position: absolute;
            left: 137px;
            top: 810px;
            font-size: 36px;
            width: 306px;
            overflow: hidden;
            font-family: "Brush Script MT";
        }
        .date3 {
            position: absolute;
            left: 685px;
            top: 450px;
            font-size: 20px;
            width: 156px;
            overflow: hidden;
        }
        .ic2 {
            position: absolute;
            left: 621px;
            top: 840px;
            font-size: 20px;
            width: 284px;
        }
        
        
        body,td,th {
            font-family: Tahoma, Geneva, sans-serif;
        }
        #Layer1 {
            position:absolute;
            width:200px;
            height:26px;
            z-index:1;
            left: 700px;
            top: -310px;
        }
        #Layer2 {
            position:absolute;
            width:205px;
            height:39px;
            z-index:2;
            left: 629px;
            top: 245px;
        }
        #Layer3 {
            position:absolute;
            width:200px;
            height:43px;
            z-index:3;
            left: 629px;
            top: -250px;
        }
        #Layer4 {
            position:absolute;
            width:200px;
            height:33px;
            z-index:4;
            left: 627px;
            top: 490px;
        }
        body {
            margin-top: 0px;
        }
        #Layer5 {
            position:absolute;
            width:702px;
            height:21px;
            z-index:1;
            left: 249px;
            top: 427px;
        }
        #Layer6 {
            position:absolute;
            width:304px;
            height:28px;
            z-index:5;
            left: 132px;
            top: 490px;
        }
        #Layer7 {
            position:absolute;
            width:304px;
            height:30px;
            z-index:6;
            left: 132px;
            top: 245px;
        }
        #Layer8 {
            position:absolute;
            width:308px;
            height:27px;
            z-index:1;
            left: 136px;
            top: 1170px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="student_type1">√</div>
        <div class="student_type2"></div>
        <div class="intake_month">{{ $data['getSelectedCourses'][0]->programmeRecord['semesterYearMapping']->semester['semester'] }}</div>
        <div class="intake_year">{{ $data['getSelectedCourses'][0]->programmeRecord['semesterYearMapping']->year }}</div>
        <div class="photo"><img src="{{ $data['profile_image'] }}"   width="100%" height="100%" /></div><div class="course_qb"></div>
        @for ($i = 0; $i < count($data['getSelectedCourses']); $i++)
            <div class="programme<?php echo $i+1; ?>">{{ $data['getSelectedCourses'][$i]->programmeRecord['programme']->en_name }}</div>
        @endfor
      
      <div class="en_name">{{ $data['userDetail']->en_name }}</div>
      <div class="ch_name"></div>
      <div class="ic">{{ $data['userDetail']->ic }}</div>
      <div class="race">{{ $data['applicantProfile']->race['name'] }}</div>
      <div class="gender">
        <table width="200" border="0" cellspacing="0" cellpadding="0">
          <tr>
            @if($data['applicantProfile']->gender['name'] == 'Male')
                <td width="101">
                    <span>√</span>
                </td>
                <td width="99">
                    <span></span>
                </td>
            @elseif($data['applicantProfile']->gender['name'] == 'Female')
                <td width="101">
                    <span></span>
                </td>
                <td width="99">        
                    <span>√</span>
                </td>
            @endif
          </tr>
      </table>
      </div>
      <div class="nationality">{{ $data['applicantProfile']->nationality['name'] }}</div>
      
      <div class="religion">{{ $data['applicantProfile']->religion['name'] }}</div>
      <div class="place_of_birth">{{ $data['applicantProfile']->place_of_birth }}</div>
      
      <div class="birth_date">{{ $data['applicantProfile']->birth_date }}</div>
      <div class="age">
        <table width="808" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="194">{{ $data['age'] }}</td>
            @if ($data['applicantProfile']->marital_id == '1')
                <td width="114">√</td>
                <td width="229"><span></span></td>
            @elseif($data['applicantProfile']->marital_id == '2')
                <td width="114"><span></span></td>
                <td width="229">√</td>
            @endif
            <td width="271">{{ $data['userDetail']->tel_hp }}</td>
          </tr>
      </table>
      </div>
      <div class="tel_home">{{ $data['userDetail']->tel_h }}</div>
      <div class="email">{{ $data['userDetail']->email }}</div>
      <div class="c_address">{{ $data['cAddress']->street1 }}, {{ $data['cAddress']->street2 }}, {{ $data['cAddress']->zipcode }}, {{ $data['cAddress']->city }}, {{ $data['cAddress']->state }}, {{ $data['cAddress']->country['name'] }}.</div>
      
      <div class="p_en_name">{{ $data['guardianUserDetail']->en_name }}</div>
      <div class="p_ch_name"></div>
      <div class="p_ic">{{ $data['guardianUserDetail']->ic }}</div>
      {{-- <div class="p_income">{{ $data['guardianDetail']->income['range'] }}</div> --}}
      <div class="p_income">{{ __( 'RM ') }}{{ $data['guardianDetail']->income }}</div>
      <div class="p_relationship">{{ $data['guardianDetail']->guardianRelationship['name'] }}</div>
      <div class="p_nationality">{{ $data['guardianDetail']->nationality['name'] }}</div>
      <div class="p_occupation">{{ $data['guardianDetail']->occupation }}</div>
      <div class="p_tel">{{ $data['guardianUserDetail']->tel_hp }}</div>
      @if ($data['guardianUserDetail']->email != null)
        <div class="p_email">{{ $data['guardianUserDetail']->email }}</div>
      @else
        <div class="p_email"></div>
      @endif

    <img src="/assets/form-template/form-part1.png" width="1000" />
    <div id="Layer5"></div>
    </div>

    <div class="container">
    <img src="/assets/form-template/form-part2.png" width="1000" />
    <div id="Layer8" class="sd_name">{{ $data['userDetail']->en_name }}</div>

    <div class="e_en_name1">{{ $data['emergencyContactUserDetail1']->en_name }}</div>
    <div class="e_ch_name1"></div>
    <div class="e_relationship1">{{ $data['emergencyContact1']->guardianRelationship['name'] }}</div>
    <div class="e_tel1">{{ $data['emergencyContactUserDetail1']->tel_hp }}</div>
    <div class="e_en_name2">{{ $data['emergencyContactUserDetail2']->en_name }}</div>
    <div class="e_ch_name2"></div>
    <div class="e_relationship2">{{ $data['emergencyContact2']->guardianRelationship['name'] }}</div>
    <div class="e_tel2">{{ $data['emergencyContactUserDetail2']->tel_hp }}</div>

    <div class="academic_record">
        <table width="100%" border="0">
            <tr>
                <td height="46" colspan="4">&nbsp;</td>
            </tr>
            
            @if ($data['academicRecord'][1]->status == 1)
                <tr>
                    <td width="17%">&nbsp;</td>
                    <td width="35%" height="56"><strong><font size="3">{{ $data['academicRecord'][1]->school_name }}</font></strong></td>
                    <td width="16%"></td>
                    <td width="32%" align="center">{{ $data['academicRecord'][1]->school_graduation }}</td>
                </tr>
            @else
                <tr>
                    <td width="17%">&nbsp;</td>
                    <td width="35%" height="56"><strong><font size="3">{{ $data['academicRecord'][0]->school_name }}</font></strong></td>
                    <td width="16%"></td>
                    <td width="32%" align="center">{{ $data['academicRecord'][0]->school_graduation }}</td>
                </tr>
            @endif
            
            @php
                $schoolLevelIndex = 3;    
                for ($i=2; $i < count($data['academicRecord']) - 1 ; $i++) { 
                    if($data['academicRecord'][$i]->status == 1 && $data['academicRecord'][$i]->school_level_id >= $schoolLevelIndex){
                        $schoolLevelIndex = $data['academicRecord'][$i]->school_level_id - 1;
                    }
                }
            @endphp
            <tr>
                <td>&nbsp;</td>
                <td height="45"><strong><font size="3">{{ $data['academicRecord'][$schoolLevelIndex]->school_name }}</font></strong></td>
                <td></td>
                <td align="center">{{ $data['academicRecord'][$schoolLevelIndex]->school_graduation }}</td>
            </tr>

            @if ($data['academicRecord'][7]->status == 1)
                <tr>
                    <td>&nbsp;</td>
                    <td height="42"><strong><font size="3">{{ $data['academicRecord'][7]->school_name }}</font></strong></td>
                    <td></td>
                    <td align="center">{{ $data['academicRecord'][7]->school_graduation }}</td>
                </tr>
            @else
                <tr>
                    <td>&nbsp;</td>
                    <td height="42"><strong><font size="3"></font></strong></td>
                    <td></td>
                    <td align="center"></td>
                </tr>
            @endif
        </table>
    </div>

    <div class="health_status">
        <table width="460" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="63" height="28" align="center" valign="middle">{{ ($data['statusOfHealth'][0]->disease_status == 1)?'√':null;}}</td>
                <td width="54" align="center" valign="middle">{{ ($data['statusOfHealth'][0]->disease_status == 0)?'√':null;}}</td>
                <td width="14">&nbsp;</td>
                <td width="329"><div>{{ $data['statusOfHealth'][0]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="29" align="center" valign="middle">{{ ($data['statusOfHealth'][1]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][1]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][1]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td width="63" height="28" align="center" valign="middle">{{ ($data['statusOfHealth'][2]->disease_status == 1)?'√':null;}}</td>
                <td width="54" align="center" valign="middle">{{ ($data['statusOfHealth'][2]->disease_status == 0)?'√':null;}}</td>
                <td width="14">&nbsp;</td>
                <td width="329"><div>{{ $data['statusOfHealth'][2]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="29" align="center" valign="middle">{{ ($data['statusOfHealth'][3]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][3]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][3]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="27" align="center" valign="middle">{{ ($data['statusOfHealth'][4]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][4]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][4]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="25" align="center" valign="middle">{{ ($data['statusOfHealth'][5]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][5]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][5]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="27" align="center" valign="middle">{{ ($data['statusOfHealth'][6]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][6]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][6]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="32" align="center" valign="middle">{{ ($data['statusOfHealth'][7]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][7]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][7]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="26" align="center" valign="middle">{{ ($data['statusOfHealth'][8]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][8]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][8]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="29" align="center" valign="middle">{{ ($data['statusOfHealth'][9]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][9]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][9]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="27" align="center" valign="middle">{{ ($data['statusOfHealth'][10]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][10]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][10]->disease_remark }}</div></td>
            </tr>
            <tr>
                <td height="29" align="center" valign="middle">{{ ($data['statusOfHealth'][11]->disease_status == 1)?'√':null;}}</td>
                <td align="center" valign="middle">{{ ($data['statusOfHealth'][11]->disease_status == 0)?'√':null;}}</td>
                <td>&nbsp;</td>
                <td><div>{{ $data['statusOfHealth'][11]->disease_remark }}</div></td>
            </tr>
        </table>
    </div>


    </div>

    <div class="container">

    <img src="/assets/form-template/form-part3.png" width="1000" />
    <div id="Layer7" class="sd_name">{{ $data['userDetail']->en_name }}</div>
    <div class="date2">{{ $data['formattedDate'] }}</div>

    <div class="guarantee_name">
    <div><font size="2">{{ $data['guardianUserDetail']->en_name }}</font></div></div>
    <div class="date3">{{ $data['formattedDate'] }}</div>

    <div class="sd_name">
    <div>{{ $data['userDetail']->en_name }}</div></div>
    <div class="ic2">{{ $data['userDetail']->ic }}</div>
    <div class="date1">{{ $data['formattedDate'] }}</div>

    <div class="sd_name" id="Layer6">{{ $data['guardianUserDetail']->en_name }}</div>
    <div class=""></div>
    <div id="Layer1" class="date2">{{ $data['formattedDate'] }}</div>
    <div id="Layer2" class="ic2">{{ $data['userDetail']->ic }}</div>
    <div id="Layer3" class="ic2">{{ $data['userDetail']->ic }}</div>
    <div id="Layer4" class="ic2">{{ $data['guardianUserDetail']->ic }}</div>
    </div>
    <div class="container"></div>
    <img src="/assets/form-template/form-part4.png" width="1000" />
</body>
</html>

