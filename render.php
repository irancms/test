public function karnamemonthrender(Request $request)
    {
        $month = $request->month;
        if ($month == 1) {
            $pmonth = 12;
        } else {
            $pmonth = $month - 1;
        }
        $class = $request->class;
        $users = User::where('role', 'دانش آموز')->where('class',  $class)->get();
        $setting = Setting::all()->first();
        foreach ($users as $user) {
            $id = $user->id;
            $idc = $class;

            $mykarnamehs = DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $month)->where('codclass', $class)
                ->where('user_id', $id)
                ->select(DB::raw('avg(mark) as avg,  coddars'))
                ->groupBy('coddars')
                ->get();

            if ($month == 7) {
                $KarnamehName = 'مهر';
            } elseif ($month == 8) {
                $KarnamehName = 'آبان';
            } elseif ($month == 9) {
                $KarnamehName = 'آذر';
            } elseif ($month == 10) {
                $KarnamehName = 'دی';
            } elseif ($month == 11) {
                $KarnamehName = 'بهمن';
            } elseif ($month == 12) {
                $KarnamehName = 'اسفند';
            } elseif ($month == 1) {
                $KarnamehName = 'فروردین';
            } elseif ($month == 2) {
                $KarnamehName = 'اردیبهشت';
            } elseif ($month == 3) {
                $KarnamehName = 'خرداد';
            } elseif ($month == 6) {
                $KarnamehName = 'شهریور';
            }

            if ($pmonth == 7) {
                $pKarnamehName = 'مهر';
            } elseif ($pmonth == 8) {
                $pKarnamehName = 'آبان';
            } elseif ($pmonth == 9) {
                $pKarnamehName = 'آذر';
            } elseif ($pmonth == 10) {
                $pKarnamehName = 'دی';
            } elseif ($pmonth == 11) {
                $pKarnamehName = 'بهمن';
            } elseif ($pmonth == 12) {
                $pKarnamehName = 'اسفند';
            } elseif ($pmonth == 1) {
                $pKarnamehName = 'فروردین';
            } elseif ($pmonth == 2) {
                $pKarnamehName = 'اردیبهشت';
            } elseif ($pmonth == 3) {
                $pKarnamehName = 'خرداد';
            } elseif ($pmonth == 6) {
                $pKarnamehName = 'شهریور';
            }

            $classnumber = $class;
            $studentnumbers = \App\student::where('classid', $classnumber)->count();
            $collection = DB::select(DB::raw("SELECT
        *,
        AVG(mark_items.mark) AS avg
      FROM mark_items
      WHERE mark_items.codclass = $class
      AND MONTH(mark_items.created_at) = '$month'
      GROUP BY mark_items.coddars,
               mark_items.user_id,
               mark_items.codclass
      ORDER BY avg DESC"));
            $rotbehh = 0;
            $rotbeh = 1;
            foreach ($collection as $mykarnameh) {
                if ($mykarnameh->user_id == $id) {
                    $rotbeh = $rotbehh;
                } else {
                    $rotbehh = $rotbehh + 1;
                }
            }
            $rankkol = $rotbeh;
            if ($rankkol == 0) {
                $rankkol = 1;
            }

            //         $collectionpaye = DB::select(DB::raw("SELECT
            //     *,
            //     AVG(mark_items.mark) AS avg
            //   FROM mark_items
            //   WHERE  MONTH(mark_items.created_at) = '$month'
            //   GROUP BY mark_items.coddars,
            //            mark_items.user_id
            //   ORDER BY avg DESC"));
            //         $rotbehhpaye = 0;
            //         $rotbehpaye = 1;

            //         foreach ($collectionpaye as $mykarnamehpaye) {
            //             if ($mykarnamehpaye->user_id == $id) {
            //                 $rotbehpaye = $rotbehhpaye;
            //             } else {
            //                 $rotbehhpaye = $rotbehhpaye + 1;
            //             }
            //         }
            //         $rankkolpaye = $rotbehpaye;
            //         if ($rankkolpaye == 0) {
            //             $rankkolpaye = 1;
            //         }

            $idk = $month;
            if (\App\Setting::all()->first()->type_mark == 1) {
                // return view('includ.karnamehrendersmonth', compact('mykarnamehs', 'moadel', 'KarnamehName', 'studentnumbers', 'rankkol', 'month', 'idk', 'id', 'idc'));
                $render1 = '<!DOCTYPE html>
                <html>
                        <head>
                        <style>
                        @font-face {
                            font-family: "yekan";
                            src: url(/admin/fonts/Yekan.eot);
                            src: url(/admin/fonts/Yekand41d.eot?#iefix) format("embedded-opentype"), url(/admin/fonts/Yekan.woff) format("woff"), url(/admin/fonts/Yekan.ttf) format("truetype"), url(/admin/fonts/Yekan.svg#BYekan) format("svg");
                            font-weight: normal;
                            font-style: normal
                        }
                        body {font-family:yekan;
                            font-size: 10pt;
                        }
                        div.blueTable {
                  border: 1px solid #1C6EA4;
                  background-color: #EEEEEE;
                  width: 100%;
                  text-align: right;
                  border-collapse: collapse;
                }
                .divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
                  border: 1px solid #AAAAAA;
                  padding: 3px 2px;
                }
                .divTable.blueTable .divTableBody .divTableCell {
                  font-size: 10px;
                }
                .blueTable .tableFootStyle {
                  font-size: 10px;
                }
                .blueTable .tableFootStyle .links {
                     text-align: right;
                }
                .blueTable .tableFootStyle .links a{
                  display: inline-block;
                  background: #1C6EA4;
                  color: #FFFFFF;
                  padding: 2px 8px;
                  border-radius: 5px;
                }
                .blueTable.outerTableFooter {
                  border-top: none;
                }
                .blueTable.outerTableFooter .tableFootStyle {
                  padding: 3px 5px; 
                }
                /* DivTable.com */
                .divTable{ display: table; }
                .divTableRow { display: table-row; }
                .divTableHeading { display: table-header-group;}
                .divTableCell, .divTableHead { display: table-cell;}
                .divTableHeading { display: table-header-group;}
                .divTableFoot { display: table-footer-group;}
                .divTableBody { display: table-row-group;}
                p {	margin: 0pt;
                    font-size: 13px; }
                        table.items {
                            border: 0.1mm solid #000000;
                        }
                        td { vertical-align: top; }
                        .items td {
                            border-left: 0.1mm solid #000000;
                            border-right: 0.1mm solid #000000;
                            border-top: 0.1mm solid #000000;
                        }
                        table thead td { background-color: #EEEEEE;
                            border: 0.1mm solid #000000;
                            font-variant: small-caps;
                        }
                        :root {
                            --bleeding: 0.2cm;
                            --margin: 0.5cm;
                          }
                          
                          @page {
                            size: A4;
                            margin: 0;
                          }
                          * {
                            box-sizing: border-box;
                          }
                          
                          body {
                            margin: 0 auto;
                            padding: 0;
                            background: rgb(204, 204, 204);
                            display: flex;
                            flex-direction: column;
                          }
                          
                          .page {
                            display: inline-block;
                            position: relative;
                            height: 297mm;
                            width: 210mm;
                            font-size: 10pt;
                            margin: 2em auto;
                            padding: calc(var(--bleeding) + var(--margin));
                            box-shadow: 0 0 0.0cm rgba(0, 0, 0, 0.5);
                            background: white;
                          }
                          
                          @media screen {
                            .page::after {
                              position: absolute;
                              content: "";
                              top: 0;
                              left: 0;
                              width: calc(100% - var(--bleeding) * 2);
                              height: calc(100% - var(--bleeding) * 2);
                              margin: var(--bleeding);
                              outline: thin dashed black;
                              pointer-events: none;
                              z-index: 9999;
                            }
                            div.footer {
                                display: none;
                            }
                          }
                          
                          @media print {
                            .page {
                              margin: 0;
                              overflow: hidden;
                            }
                            div.footer {
                                position: fixed;
                                bottom: 1cm;
                                width: 210mm;
                            }
                          }
                        </style>
                        </head>
                        <body dir="rtl">
                        <div class="page">
                        <htmlpageheader name="myheader">
                        <table width="100%">
                        <tr>
                        <td width="10%" style="text-align: left;"><img style="width: 200px; padding-top:20px" src="/uploads/' . $setting->logo . '"></td>
                        <td width="45%" style="padding-right:10px;padding-top:10px;border: 1px solid black;border-collapse: collapse;color:#000000; ">
                        <span style="font-weight: bold; font-size: 10pt;">' . $setting->name . ' </span><br /><br /><br />
                        <center><span>پایه: ' . $user->paye . ' &nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp; کلاس: ' . $user->class . '</span></center>
                        </td>
                        <td width="1%"><span>&nbsp;</span></td>
                        <td width="44%" style="padding-right:10px;padding-top:10px;border: 1px solid black;border-collapse: collapse;color:#000000; ">
                        <span>نام: </span><span style="font-weight: bold; font-size: 10pt;"> ' . $user->f_name . ' </span><br />
                        <span>نام خانوادگی: </span><span style="font-weight: bold; font-size: 10pt;"> ' . $user->l_name . ' </span><br />
                        <span>نام پدر: </span><span style="font-weight: bold; font-size: 10pt;"> ' . $user->fname . ' </span><br />
                        <span>کد ملی: </span><span style="font-weight: bold; font-size: 10pt;"> ' . $user->codemeli . ' </span><br />
                        </td>
                        </tr>
                        </table>
                        <center><b style="font-size: 12pt;">کارنامه ' . $KarnamehName . ' ماه</b></center><br>
                        </htmlpageheader>
                        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
                        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
                            <tbody>
                            <tr>
                            <td style="background-color: #EEEEEE;text-align:center">#</td>
                            <td style="background-color: #EEEEEE;text-align:center">نام درس</td>
                            <td style="background-color: #EEEEEE;text-align:center">واحد</td>
                            <td style="background-color: #EEEEEE;text-align:center">نمره شما</td>
                            <td style="background-color: #EEEEEE;text-align:center">بالاترین نمره کلاس</td>
                            <td style="background-color: #EEEEEE;text-align:center">میانگین نمره کلاس</td>
                            <td style="background-color: #EEEEEE;text-align:center">رتبه در کلاس</td>
                            <td style="background-color: #EEEEEE;text-align:center" >رتبه در پایه</td>
                            </tr>
                            </tbody>';
                echo $render1;
                $idn = 1;
                $moadel = 0;
                $topmoadel = 0;
                $avgmoadel = 0;
                $marks = 0;
                $vaheds = 0;
                foreach ($mykarnamehs as $mykarnameh) {
                    echo '<tr>
                            <td style="background-color: #fff;text-align:center">' . $idn . '</td>
                            <td style="background-color: #fff;text-align:right">' . \App\dars::where('id', $mykarnameh->coddars)->first()['name'] . '</td>
                            <td style="background-color: #fff;text-align:center">' . \App\dars::where('id', $mykarnameh->coddars)->first()['vahed'] . '</td>
                            <td style="background-color: #fff;text-align:center">' . round($mykarnameh->avg, 2) . '</td>
                            <td style="background-color: #fff;text-align:center">' . $this->gettop($idk, $mykarnameh->coddars) . '</td>
                            <td style="background-color: #fff;text-align:center">' . $this->getavg($idk, $mykarnameh->coddars) . '</td>
                            <td style="background-color: #fff;text-align:center">' . $this->getclassrank($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) . '</td>
                            <td style="background-color: #fff;text-align:center" >' . $this->getpayerank($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) . '</td>
                            </tr>';
                    $idn = $idn + 1;

                    $vahed = \App\dars::where('id', $mykarnameh->coddars)->first()['vahed'];
                    $mark = ($mykarnameh->avg) * $vahed;
                    $vaheds = $vaheds + $vahed;
                    $marks = $marks + $mark;

                    // $moadel = $moadel + $mykarnameh->avg;
                    $topmark = ($this->gettop($idk, $mykarnameh->coddars)) * $vahed;
                    $topmoadel = $topmoadel + $topmark;
                    $avgmark = ($this->getavg($idk, $mykarnameh->coddars)) * $vahed;
                    $avgmoadel = $avgmoadel +  $avgmark;
                }
                if (
                    $vaheds == 0
                ) {
                    $moadel = 0;
                    $topmoadel = 0;
                    $avgmoadel = 0;
                } else {
                    $moadel = round($marks / $vaheds, 2);
                    $topmoadel = round($topmoadel / $vaheds, 2);
                    $avgmoadel = round($avgmoadel / $vaheds, 2);
                }
                // $moadel = $moadel / ($idn - 1);
                // $topmoadel = $topmoadel / ($idn - 1);
                // $avgmoadel = $avgmoadel / ($idn - 1);
                $render2 = '<tr>
                <td colspan="2" style="background-color: #EEEEEE;text-align:left"> معدل:</td>
                <td colspan="2" style="background-color: #fff;text-align:center">' . round($moadel, 2) . '</td>
                <td style="background-color: #fff;text-align:center">' . $topmoadel . '</td>
                <td style="background-color: #fff;text-align:center" >' . $avgmoadel . '</td>
                <td colspan="1" style="background-color: #EEEEEE;text-align:center;" >رتبه کلی در کلاس:</td>
                <td colspan="1" style="background-color: #fff;text-align:center;" >' . $rankkol . '</td>
                </tr></table><br>
                توجه: کارنامه فوق میانگین نمرات کسب شده توسط شما در ' . $KarnamehName . ' ماه می باشد.<br><br>';
                echo $render2;
                $idn = $idn + 1;

                $render3 = '
                        <div class="footer" style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
                        سامانه مدیریت آموزش مدارس (سَمام)
                        </div>
                        </div>
                        </body>
                        </html>';
                echo $render3;

                $render1 = '<!DOCTYPE html>
                <html>
                        <head>
                        <style>
                        @font-face {
                            font-family: "yekan";
                            src: url(/admin/fonts/Yekan.eot);
                            src: url(/admin/fonts/Yekand41d.eot?#iefix) format("embedded-opentype"), url(/admin/fonts/Yekan.woff) format("woff"), url(/admin/fonts/Yekan.ttf) format("truetype"), url(/admin/fonts/Yekan.svg#BYekan) format("svg");
                            font-weight: normal;
                            font-style: normal
                        }
                        body {font-family:yekan;
                            font-size: 10pt;
                        }
                        div.blueTable {
                  border: 1px solid #1C6EA4;
                  background-color: #EEEEEE;
                  width: 100%;
                  text-align: right;
                  border-collapse: collapse;
                }
                .divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
                  border: 1px solid #AAAAAA;
                  padding: 3px 2px;
                }
                .divTable.blueTable .divTableBody .divTableCell {
                  font-size: 10px;
                }
                .blueTable .tableFootStyle {
                  font-size: 10px;
                }
                .blueTable .tableFootStyle .links {
                     text-align: right;
                }
                .blueTable .tableFootStyle .links a{
                  display: inline-block;
                  background: #1C6EA4;
                  color: #FFFFFF;
                  padding: 2px 8px;
                  border-radius: 5px;
                }
                .blueTable.outerTableFooter {
                  border-top: none;
                }
                .blueTable.outerTableFooter .tableFootStyle {
                  padding: 3px 5px; 
                }
                /* DivTable.com */
                .divTable{ display: table; }
                .divTableRow { display: table-row; }
                .divTableHeading { display: table-header-group;}
                .divTableCell, .divTableHead { display: table-cell;}
                .divTableHeading { display: table-header-group;}
                .divTableFoot { display: table-footer-group;}
                .divTableBody { display: table-row-group;}
                p {	margin: 0pt;
                    font-size: 13px; }
                        table.items {
                            border: 0.1mm solid #000000;
                        }
                        td { vertical-align: top; }
                        .items td {
                            border-left: 0.1mm solid #000000;
                            border-right: 0.1mm solid #000000;
                            border-top: 0.1mm solid #000000;
                        }
                        table thead td { background-color: #EEEEEE;
                            border: 0.1mm solid #000000;
                            font-variant: small-caps;
                        }
                        :root {
                            --bleeding: 0.2cm;
                            --margin: 0.5cm;
                          }
                          
                          @page {
                            size: A4;
                            margin: 0;
                          }
                          * {
                            box-sizing: border-box;
                          }
                          
                          body {
                            margin: 0 auto;
                            padding: 0;
                            background: rgb(204, 204, 204);
                            display: flex;
                            flex-direction: column;
                          }
                          
                          .page {
                            display: inline-block;
                            position: relative;
                            height: 297mm;
                            width: 210mm;
                            font-size: 10pt;
                            margin: 2em auto;
                            padding: calc(var(--bleeding) + var(--margin));
                            box-shadow: 0 0 0.0cm rgba(0, 0, 0, 0.5);
                            background: white;
                          }
                          
                          @media screen {
                            .page::after {
                              position: absolute;
                              content: "";
                              top: 0;
                              left: 0;
                              width: calc(100% - var(--bleeding) * 2);
                              height: calc(100% - var(--bleeding) * 2);
                              margin: var(--bleeding);
                              outline: thin dashed black;
                              pointer-events: none;
                              z-index: 9999;
                            }
                            div.footer {
                                display: none;
                            }
                          }
                          
                          @media print {
                            .page {
                              margin: 0;
                              overflow: hidden;
                            }
                            div.footer {
                                position: fixed;
                                bottom: 1cm;
                                width: 210mm;
                            }
                          }
                        </style>
                        </head>
                        <body dir="rtl">
                        <div class="page">
                        <htmlpageheader name="myheader">
                        <center><b style="font-size: 12pt;">تحلیل کارنامه ' . $KarnamehName . ' ماه</b> ( '.$user->f_name.' '.$user->l_name.' )</center><br>
                        </htmlpageheader>
                        <sethtmlpageheader name="myheader" value="on" show-this-page="1" /><br><br>';
                echo $render1;
                foreach ($mykarnamehs as $mykarnameh) {
                    if ($this->getclassdeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) == 0) {
                        $cloop = "تغییری نکرده";
                    } elseif ($this->getclassdeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) > 0) {
                        $cloop = $this->getclassdeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) . " پله رشد داشته";
                    } elseif ($this->getclassdeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) < 0) {
                        $cloop = abs($this->getclassdeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg)) . " پله افت داشته";
                    }

                    if ($this->getpayedeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) == 0) {
                        $ploop = "تغییری نکرده";
                    } elseif ($this->getpayedeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) > 0) {
                        $ploop = $this->getpayedeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) . " پله رشد داشته";
                    } elseif ($this->getpayedeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg) < 0) {
                        $ploop = abs($this->getpayedeveloop($idk, $mykarnameh->coddars, $id, $mykarnameh->avg)) . " پله افت داشته";
                    }
                    echo '<p style="text-align: justify;">رتبه شما در درس ' . \App\dars::where('id', $mykarnameh->coddars)->first()['name'] . ' نسبت به ' . $pKarnamehName . ' ماه در بین دانش آموزان کلاس ' . $class . '، ' . $cloop . ' و همچنین در بین دانش آموزان پایه ' . $user->paye . '، ' . $ploop . ' است.</p>';
                    $idn = $idn + 1;
                }
                $render3 = '
                        <div class="footer" style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
                        سامانه مدیریت آموزش مدارس (سَمام)
                        </div>
                        </div>
                        </body>
                        </html>';
                echo $render3;
            } else {
                if ($moadel > 3) {
                    $moadel = 'خیلی خوب';
                } elseif (($moadel < 3) && ($moadel >= 2)) {
                    $avg = 'خوب';
                } elseif (($moadel < 2) && ($moadel >= 1)) {
                    $avg = 'قابل قبول';
                } elseif ($moadel < 1) {
                    $avg = 'نیاز به تلاش مجدد';
                }
                return view('includ.karnamehrendersmonthtosify', compact('mykarnamehs', 'moadel', 'KarnamehName', 'studentnumbers', 'rankkol', 'month', 'idk', 'id', 'idc'));
            }
        }
    }
