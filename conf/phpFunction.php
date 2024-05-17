<?PHP


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$_p0	= isset($_REQUEST['_p0']) ? strval($_REQUEST['_p0']) : '';	
$_p1	= isset($_REQUEST['_p1']) ? strval($_REQUEST['_p1']) : '';	
$_p2	= isset($_REQUEST['_p2']) ? strval($_REQUEST['_p2']) : '';	
$_p3	= isset($_REQUEST['_p3']) ? strval($_REQUEST['_p3']) : '';	

function requestRec($loadField, $loadTbl, $loadWhere, $loadOrder, $limit, $typeView){
$carouselCount = 0;

	$sql = "SELECT $loadField FROM $loadTbl";
	if(!empty($loadWhere)) { $sql.=" WHERE $loadWhere"; }
	if(!empty($loadOrder)){ $sql.=" ORDER BY $loadOrder"; }
	if(!empty($limit)){ $sql.=" LIMIT $limit"; }

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;
	
	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];
		
		switch($typeView){
			
			case 1:

			
				// GET DATA BANNER
				$image = 'images/banners/'.$row[1];


				if (strlen($row[0])>3) {
					$title = $row[0];
					$line = '<span></span>';
				} else {
					$title = '';
					$line = '';
				}
				
				$view = 

				'
				<div class="banner-slideshow">
					<img src="'.$image.'" alt="Banner '.$title.'">
					<div class="swiper-pagination"></div>
				</div>
				
				';

				break;

			case 2:

				// GET DATA LEAD

				$nama			= strtolower($row[0]);
				$desk			= $row[1];
				$lhkpn		= $row[2];
				$jabatan 	= $row[3];
				$image		= 'images/employees/'.$row[4];
				
				

				$_convertNama	= ucwords($nama, " ");
				
				$view =
				
				'
				
				<div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="'.$image.'" class="testimonial-img" alt="">
                                <h2>'.$_convertNama.'</h2>
								<p>
								<i class="bi bi-quote quote-icon-left"></i>
								<span>"'.$desk.'"</span>
								<i class="bi bi-quote quote-icon-right"></i>
							  </p>
								<a
						class=" btn btn--gradient"
						href="files/'.$lhkpn.'" target="_blank"
						data-aos="fade-up"
						data-aos-delay="100" 
					  >
						<span class="text" style="padding:20px ;">LHKPN</span>
					  </a>
                            </div>
                        </div>

				
				';
		
				break;

			case 3:

				// GET DATA SERVICES

				$id 		= $row[0];
				$nama 	= $row[1];
				$desk 	= strip_tags($row[2]);
				$dir_image = 'images/post/'.$row[3];

				// VARIABEL NEED OPERATION


				if (!empty($row['post_img'] && file_exists($dir_image) )) {
					$src = 'images/post/'.$row[3];
				} else {
					$src = 'images/post/default-services.png';
				}


				$deskToFirst = ucfirst($desk);


				// if(!empty($row[3])){
				// 	$image = 'images/services/'.$row[3];

				// } else {
				// 	$image = 'images/sidoarjo.png';
				// }
				
				$view = 
				'
				<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="'.$src.'" style="width:80px ; height:80px ;"></img></div>
                            <h4><a href="005/'.$id.'" class="stretched-link">'.$nama.'</a></h4>
                            <p>'.substr($deskToFirst, 0, 100).'</p>
                        </div>
                    </div>
				';
			
				break;

			case 4:

				// GET DATA NEWS

				$id 		= $row[0];
				$title 	= $row[1];
				$desk 	= $row[2];
				$date 	= $row[3];
				$count 	= $row[4];

				$dir_image = 'images/post/'.$row[5];

				// VARIABEL NEED OPERATION


				if (!empty($row['post_img'] && file_exists($dir_image) )) {
					$src = 'images/post/'.$row[5];
				} else {
					$src = 'images/post/default.png';
				}

				$dateString 	= DateTime::createFromFormat('Y-m-d', $date);
				$dayEng	= $dateString->format('l');


				$listDayIn = array(
					'Sunday' => 'Minggu',
					'Monday' => 'Senin',
					'Tuesday' => 'Selasa',
					'Wednesday' => 'Rabu',
					'Thursday' => 'Kamis',
					'Friday' => 'Jumat',
					'Saturday' => 'Sabtu'
				);
				

				$dayIn = $listDayIn[$dayEng];
				$_convertDate = $dayIn . ', ' . $dateString->format('d F Y');

				$deskToStr = strip_tags($desk);
				
				$view 	= 
				
				'
				<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="'.$src.'" class="img-fluid" alt=""></div>
                            <div class="member-info">
								<h4><a href="001/'.$id.'">'.$title.'</a></h4>
                                <p>'.substrwords($deskToStr, 100).'</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""> <i class="bi bi-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
					
				
				'
				;
				
				
				break;


			case 5:


				$_val2	= $row[2];
				$_val3	= $row[3];
				$_val4	= $row[4];
				$_val5	= $row[5];
				$_max = '100';
				$_href	= '#view-'.$loadTbl.'-'.$_val.'-'.$_disp;
				
				$view = '<div class="col-md-4">
							<div class="card card-blog">
								<div class="card-image">
									<a href="#"> <img class="img" src="/upload/'.$_val.$_val4.'"> </a>
									<div class="ripple-cont"></div>
								</div>
								<div class="table">
									<h4 class="card-caption">
										<a href="'.$_href.'">'.$_disp.'</a>
									</h4>
									<p class="card-description">'.substrwords($_val2, $_max).'...</p>
									<div class="ftr">
										<div class="author">
											<i class="fa fa-calendar" aria-hidden="true"></i> '.$_val3.'
										</div>
										<div class="stats"> 
											<i class="fa fa-eye"></i> '.$_val5.'
										</div>
									</div>
								</div>
							</div>
						</div>';
				break;

			case 6:

				// GET DATA VIDEO

				$id = $row[0];
				$url = $row[1];
				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$videoId = $params['v'];

				
				$view = 
				
				'
				<div data-video="'.$videoId.'" class="carousel-item active">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$videoId.'" frameborder="0" rel="0" allowfullscreen style="width: 100%; height: 100%;"></iframe>
				</div>
				
				
				';
				
				break;

			case 7:

				// GET DATA GALERY

				$title = $row[0];
				$desk = $row[1];
				$image = 'images/banners/'.$row[2];

				$view = 
				
				'
				<div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="'.$image.'" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>'.$title.'</h4>
                                <p>'.$desk.'</p>
                                <a href="'.$image.'" title="'.$title.'"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div>

				';
				
				break;

			case 8:

				// GET DATA ANNOUNCEMENT

				$id			= $row[0];
				$title 		= strtolower($row[1]);
				$desk 		= $row[2];

				$_convert 	= ucwords($title, " ");

				$view = 
				
				'

				<div class="announcement-item">
					<div class="announcement-contents">
						<a href="003/'.$id.'"><h3>'.$_convert.'</h3></a>
						<p>'.$desk.'</p>
					</div>
				</div>

				';
				
				break;

			case 9:

				// GET DATA EVENT

				$id 			= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$startDate 	= $row[3];
				$endDate 	= $row[4];
				$image 		= 'images/post/'.$row[5];


				$dir_image = 'images/post/'.$row[5];

				if (!empty($row['post_img'] && file_exists($dir_image) )) {
					$src = 'images/post/'.$row[5];
				} else {
					$src = 'images/post/default.png';
				}

				$deskToStr = strip_tags($desk);

				if (strlen($deskToStr) > 200) {
					$deskTruncate = substrwords($deskToStr, 200);
				} else {
					$deskTruncate = $deskToStr;
				}
				
				$view 	= 
				
				'

				<div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
				<i class="faq-icon bi bi-question-circle"></i>
				<h3>'.$title.'</h3>
				<div class="faq-content">
					</span>'.dateToDMY($startDate).' -</span>
					</span>'.dateToDMY($endDate).'</span>
					<p>'.$deskTruncate.'</p>
				</div>
				<i class="faq-toggle bi bi-chevron-right"></i>
			</div>
			
				
				'
				;
				
				
				break;

				case 10:

					// GET DATA SOCIAL
	
					$title 	= strtolower($row[0]);
					$url 	= $row[1];
	
					$view = 
					
					'
					<li><a href="'.$url.'" target="_blank"><span class="icon-'.$title.'"></span></a></li>
	
					';
					
					break;

				case 11:

					// GET DATA LINK TERKAIT
	
					$title 	= strtolower($row[0]);
					$url 		= $row[1];

					if (!empty($row[2])) {
						$src = './images/socials/'.$row[2];
					} else {
						$src = './images/tautan/default.png'; // Ganti dengan path gambar default Anda
					}
	
					$view = 
					
					'
					
					<div class="swiper-slide"><img src="'.$src.'" class="img-fluid" alt="Gambar '.$title.'">
					</div>
					
	
	
					';
					
					break;
				

		
			}
		
		$rowLoad .= $view;
	}
	
	return $rowLoad;
}

function jsonData($loadField, $loadTbl, $loadWhere, $loadOrder, $typeView){

	$sql = "SELECT $loadField FROM $loadTbl";
	if(!empty($loadWhere)) { $sql.=" WHERE $loadWhere"; }
	if(!empty($loadOrder)){ $sql.=" ORDER BY $loadOrder"; }

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;
	
	while ($row = $result->fetch_array()) {
		
		switch($typeView){
			case 1 :
				$_val0	= $row[0];
				$_val1	= $row[1];
				$_val2	= $row[2];
				$_val3	= $row[3];
				//$_val4	= strtotime($row[4]);
				if(!empty($row[4])){
					list($_day, $_tgl, $_bln, $_thn, $_dll) = explode(' ', $row[4]);
					$_val4	= $_thn.'-'.date('m',strtotime($_bln)).'-'.$_tgl;
					//$_val4	= date('m',strtotime($_bln)).'/'.$_tgl.'/'.$_thn;
				}
				$_val5	= $row[5];
				$data[] = ['id'=>$_val0, 'name'=>$_val2, 'description'=>'', 'date'=>$_val4, 'type'=>'event'];
				
				break;
			case 2:
					if($rowNum!=0){
						$data = $result->fetch_assoc();
						
						echo json_encode($data);
					} else {
						echo json_encode(array('stats'=>404,'msgErrors'=>'Data tidak ditemukan'));
					}
				break;
		}
		
	}
	
	return json_encode($data);
}

function hrefAside($field, $tbl, $sqlJoin, $sqlWhere, $sqlOrder){
	
	$sql = "SELECT $field FROM $tbl";
	if(!empty($sqlJoin)) { $sql.=" $sqlJoin"; }
	if(!empty($sqlWhere)) { $sql.=" WHERE $sqlWhere"; }
	if(!empty($sqlOrder)){ $sql.=" ORDER BY $sqlOrder"; }

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	
	while ($row = $result->fetch_array()) {
		$_var1 = $row[0];
		$_var2 = $row[1];
		$_var2c = str_replace(" ","-","$row[1]");
		$_var3 = $row[2];
		$_var4 = $row[3];
		
		//a.ka_id, a.ka_name, a.fm_id, b.fm_file
		
		$view =	"<li>".
					"<a href=\"javascript:void(0)\" onClick=\"goPublic('$_var4','$_var1','$_var2c','publikasi_data_$_var2c')\">".
					"<span class=\"nav-link-text\" data-i18n=\"nav.settings_user\">$_var2</span>".
					"</a>".
				"</li>";
		
		$rowLoad .= $view;
	}
	
	return $rowLoad;
}

function privAcc($txtbread, $priv){

	//$arBread = explode('_', $txtbread);
	//$bread = end($arBread);

	$result = $GLOBALS['mysqli']->query("SELECT COUNT(*) AS nRec, a.page_id, a.page_name, a.page_addr, b.ro_id, b.rr_read, b.rr_cre, b.rr_up, b.rr_del
								FROM set_page a
									LEFT JOIN set_rules b
										ON a.page_id = b.page_id AND b.ro_id='$priv'
								WHERE a._active=1 AND a.page_addr='$txtbread'
								GROUP BY a.page_id")
							or die('Ada kesalahan pada query tampil data transaksi: '.$mysqli->error);

	
	$row = $result->fetch_assoc();

	//return array('_num'=>$row['nRec'],'_re'=>$row['rr_read'],'_cr'=>$row['rr_cre'],'_up'=>$row['rr_up'],'_de'=>$row['rr_del']);
	
	if($txtbread=$row['page_name']){
		//return array('_re'=>$row['rr_read'],'_cr'=>$row['rr_cre'],'_up'=>$row['rr_up'],'_de'=>$row['rr_del']);
		return array('_num'=>$row['nRec'],'_re'=>$row['rr_read'],'_cr'=>$row['rr_cre'],'_up'=>$row['rr_up'],'_de'=>$row['rr_del']);
	}else {
		header("Location: 404.php");
	}
	
	die();

}
function updateOneField($loadField, $loadTbl, $loadWhere){
	
	$sql = "UPDATE $loadTbl AS t1, (SELECT $loadField FROM $loadTbl WHERE $loadWhere) as t2
				SET t1.$loadField = t2.$loadField+1 
				WHERE $loadWhere";
	
	$result = $GLOBALS['mysqli']->query($sql);
}

function updateField($setField, $setTbl, $setWhere){
	$sql = "UPDATE $setTbl
				SET $setField
				WHERE $setWhere";
	
	$result = $GLOBALS['mysqli']->query($sql);
}

function loadRecText($field, $table, $condition){
	
	$sql = "SELECT $field FROM $table WHERE $condition";
	$result = $GLOBALS['mysqli']->query($sql);
	$row = $result->fetch_assoc();
	
	return $row[$field];
}

function logSites($dt, $IP, $OS, $BR){
	//logSites($dateYMD, getIP(), get_operating_system(), get_the_browser());

	$logid = $dt.str_pad(loadRecText('count(*)', 'counter', 'countid LIKE "'.$dt.'%"')+1, 3, '0', STR_PAD_LEFT);
	
	$sql = "INSERT INTO counter
				VALUES ('$logid', '$IP', '$BR', '$OS', SYSDATE())";
	
	$result = $GLOBALS['mysqli']->query($sql);
	
	//return $rowLoad;
}

function sidebarLi($loadPage, $textdisp){
	$rest = "<li><a href=\"javascript:void(0);\" onClick=\"$loadPage\"><span class=\"sub-item\">$textdisp</span></a></li>";
	return $rest;
}

function tgl_panjang($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function tgl_pendek($tanggal){
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agust',
		'Sept',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function tgljam($tanggal){
	list($tgl, $jam) = explode(' ', $tanggal);
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agust',
		'Sept',
		'Okt',
		'Nov',
		'Des'
	);
	
	list($th, $bl, $tg) = explode('-', $tgl);
	if($th==date('Y')){
		$th = '';
	}
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $tg.' '.$bulan[(int)$bl].' '.$th;
}

function substrwords($text, $maxchar, $end='...') {
	$text = strip_tags($text);
	if (strlen($text) > $maxchar || $text == '') {
		$words = preg_split('/\s/', $text);      
		$output = '';
		$i      = 0;
		while (1) {
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				} 
				else {
					$output .= " " . $words[$i];
					++$i;
				}
		}
		$output .= $end;
	} 
	else {
		$output = $text;
	}
	return $output;
}

function beda_waktu($date1, $date2, $format = false) 
{
	$diff = date_diff( date_create($date1), date_create($date2) );
	if ($format)
		return $diff->format($format);
	
	return array('y' => $diff->y,
				'm' => $diff->m,
				'd' => $diff->d,
				'h' => $diff->h,
				'i' => $diff->i,
				's' => $diff->s
			);
}

//START EMAIL HIDDEN//
function mask($str, $first, $last) {
	$len = strlen($str);
	$toShow = $first + $last;
	return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}

function mask_email($email) {
	$mail_parts = explode("@", $email);
	$domain_parts = explode('.', $mail_parts[1]);

	$mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
	$domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
	$mail_parts[1] = implode('.', $domain_parts);

	return implode("@", $mail_parts);
}
//END EMAIL//

//SIDOARJO DALAM ANGKA
function curWord($cu){
	$cux = number_format($cu, 0);
	$lenCux = strlen($cux);

	if($lenCux>8){
		if(substr($cux,2,1)!=0){
			switch($lenCux){
				case 9:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux.' Juta';
					break;
				case 13:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux.' M';
					break;
				case 17:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux.' T';
					break;
			}
		} else {
			switch($lenCux){
				case 9:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux.' Juta';
					break;
				case 13:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux.' M';
					break;
				case 17:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux.' T';
					break;
			}
		}
	} else {
		$combine = $cux;
	}
	
	return $combine;
}
//END SIDOARJO DALAM ANGKA

//date ago
function TimeAgo ($oldTime, $newTime) {
$timeCalc = strtotime($newTime) - strtotime($oldTime);
if ($timeCalc >= (60*60*24*30*12*2)){
	$timeCalc = intval($timeCalc/60/60/24/30/12) . " years ago";
	}else if ($timeCalc >= (60*60*24*30*12)){
		$timeCalc = intval($timeCalc/60/60/24/30/12) . " year ago";
	}else if ($timeCalc >= (60*60*24*30*2)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " months ago";
	}else if ($timeCalc >= (60*60*24*30)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " month ago";
	}else if ($timeCalc >= (60*60*24*2)){
		$timeCalc = intval($timeCalc/60/60/24) . " days ago";
	}else if ($timeCalc >= (60*60*24)){
		$timeCalc = " Yesterday";
	}else if ($timeCalc >= (60*60*2)){
		$timeCalc = intval($timeCalc/60/60) . " hours ago";
	}else if ($timeCalc >= (60*60)){
		$timeCalc = intval($timeCalc/60/60) . " hour ago";
	}else if ($timeCalc >= 60*2){
		$timeCalc = intval($timeCalc/60) . " minutes ago";
	}else if ($timeCalc >= 60){
		$timeCalc = intval($timeCalc/60) . " minute ago";
	}else if ($timeCalc > 0){
		$timeCalc .= " seconds ago";
	}
return $timeCalc;
}

//end date ago

// mail function ============================================================
function sendOTP($email,$otp) {

   require 'src/Exception.php';
   require 'src/PHPMailer.php';
   require 'src/SMTP.php';

	require('config.php');

	$profile =  $mysqli->query('SELECT prof_snm from pub_profile WHERE _active=1 ORDER BY _cre DESC');
	$prof = $profile->fetch_all(MYSQLI_ASSOC);



	$message_body = "Terima kasih telah memberikan kritik dan saran melalui ".	$prof[0]['prof_snm']." Kabupaten Sidoarjo <br/> Verifikasi kritik dan saran harap masukkan kode OTP berikut ini: :<br/><br/>" . $otp;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = 'tls';
	$mail->Port     = 587;
	$mail->Username = 'shorashiro15@gmail.com';
	$mail->Password = 'xqzzctjnoclcgbaq';
	$mail->Host     = 'smtp.gmail.com';
	$mail->Mailer   = 'smtp';
	$mail->SetFrom('shorashiro15@gmail.com');
	$mail->AddAddress($email);
	$mail->Subject = "OTP Verifikasi";
	$mail->MsgHTML($message_body);
	$mail->IsHTML(true);
	$result = $mail->Send();
	
	return $result;
}
//============================================================================

function enc($cry) {
	$cry = base64_encode(md5("pass@w0rd".trim($cry.'--SITES--')));

	return $cry;
}



function getIP(){
	if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
		if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
			$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
			$ip = trim($addr[0]);
		} else {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

function get_operating_system() {
	$u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$operating_system = 'Other';

	if($u_agent) {
		if (preg_match('/linux/i', $u_agent)) {
			$operating_system = 'Linux';
		} elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
			$operating_system = 'Mac';
		} elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
			$operating_system = 'Windows';
		} elseif (preg_match('/ubuntu/i', $u_agent)) {
			$operating_system = 'Ubuntu';
		} elseif (preg_match('/iphone/i', $u_agent)) {
			$operating_system = 'IPhone';
		} elseif (preg_match('/ipod/i', $u_agent)) {
			$operating_system = 'IPod';
		} elseif (preg_match('/ipad/i', $u_agent)) {
			$operating_system = 'IPad';
		} elseif (preg_match('/android/i', $u_agent)) {
			$operating_system = 'Android';
		} elseif (preg_match('/blackberry/i', $u_agent)) {
			$operating_system = 'Blackberry';
		} elseif (preg_match('/webos/i', $u_agent)) {
			$operating_system = 'Mobile';
		}
	} else {
		$operating_system = php_uname('s');
	}
	
	return $operating_system;
}

function get_the_browser()
{
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
		return 'Internet explorer';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)
		return 'Internet explorer';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
		return 'Mozilla Firefox';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
		return 'Google Chrome';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
		return "Opera Mini";
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false)
		return "Opera";
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') !== false)
		return "Microsoft Edge";
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
		return "Safari";
}



$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

function generateShareLink($social_media, $url) {
   switch($social_media) {
		case 'facebook':
			return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
		case 'twitter':
			return 'https://twitter.com/intent/tweet?url=' . urlencode($url);
		case 'whatsapp':
			return 'https://api.whatsapp.com/send?text=' . urlencode($url);
		case 'instagram':
         return 'https://www.instagram.com/share?url=' . urlencode($url);
		default:
			return '#';
   }
}

function strOrganisasi(){
	
	$sql = "SELECT pub_employees.emp_nik, pub_employees.emp_img, pub_employees.emp_nm, pub_employees.jab_id, pub_employees.parent, set_jabdept.jab_nm FROM 
			pub_employees JOIN set_jabdept ON pub_employees.jab_id = set_jabdept.jab_id";

	$result = $GLOBALS['mysqli']->query($sql);
	$json = [];

	while($row = $result->fetch_assoc()){
		$json[] = ['id'=>$row['emp_nik'], 'name'=>$row['emp_nm'], 'image'=>$row['emp_img'], 'position'=>$row['jab_nm'], 'parentId'=>$row['parent']];
	}

	return json_encode($json);

}

function jsonEvent(){
	$sql = "SELECT post_id, post_judul, post_publish, post_datex FROM pub_post WHERE ca_id='002'";
	
	$result = $GLOBALS['mysqli']->query($sql);
	$json = [];

	while($row = $result->fetch_assoc()){
		$json[] = ['title'=>$row['post_judul'], 'start'=>$row['post_publish'], 'end'=>$row['post_datex'], 'url'=>'002/'.$row['post_id']];
	}

	return json_encode($json);
}



function addVisitToDatabase($ip_address, $os, $browser, $visit_date) {
	require('config.php');

	$getDate 	= date('Y-m-d H:i:s');
	$timestamp 	= strtotime($getDate);
	$sql 			= "INSERT INTO visitors (vs_id, vs_ip, vs_os, vs_brow, vs_date) VALUES ('$timestamp','$ip_address', '$os', '$browser', '$visit_date')";

	mysqli_query($mysqli, $sql);
	mysqli_close($mysqli);

}

function postSee($post_id){
	require('config.php');
	$updatePostSee = "UPDATE pub_post SET post_see = post_see + 1 WHERE post_id = $post_id";
	mysqli_query($mysqli, $updatePostSee);
}


function dateToDMY($tanggal) {
	$bulan = array(
		'January'   => 'Januari',
		'February'  => 'Februari',
		'March'     => 'Maret',
		'April'     => 'April',
		'May'       => 'Mei',
		'June'      => 'Juni',
		'July'      => 'Juli',
		'August'    => 'Agustus',
		'September' => 'September',
		'October'   => 'Oktober',
		'November'  => 'November',
		'December'  => 'Desember'
	);

	$dateTimestamp = strtotime($tanggal);
	$namaBulan = $bulan[date('F', $dateTimestamp)];
	$converted_date = date('d', $dateTimestamp) . ' ' . $namaBulan . ' ' . date('Y', $dateTimestamp);
	
	return $converted_date;
}


function strtoTimeDetail($id) {
	$dateTimestamp = date('l, d F Y | H.i', $id);

	$hari = array(
		'Sunday'    => 'Minggu',
		'Monday'    => 'Senin',
		'Tuesday'   => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday'  => 'Kamis',
		'Friday'    => 'Jumat',
		'Saturday'  => 'Sabtu'
	);

	$bulan = array(
		'January'   => 'Januari',
		'February'  => 'Februari',
		'March'     => 'Maret',
		'April'     => 'April',
		'May'       => 'Mei',
		'June'      => 'Juni',
		'July'      => 'Juli',
		'August'    => 'Agustus',
		'September' => 'September',
		'October'   => 'Oktober',
		'November'  => 'November',
		'December'  => 'Desember'
	);

	if (!is_numeric($id)) {
		$dateTimestamp = strtotime($id);
	} else {
		$dateTimestamp = $id;
	}

	$namaHari = $hari[date('l', $dateTimestamp)];
	$namaBulan = $bulan[date('F', $dateTimestamp)];

	$_convertDate = $namaHari . ', ' . date('d', $dateTimestamp) . ' ' . $namaBulan . ' ' . date('Y', $dateTimestamp) . ' | ' . date('H.i', $dateTimestamp);

	return $_convertDate;
}


function dateToDay($date){
	$dateString = DateTime::createFromFormat('Y-m-d', $date);
	$dayEng = $dateString->format('l');
	
	$listDayIn = array(
		'Sunday' => 'Minggu',
		'Monday' => 'Senin',
		'Tuesday' => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'Jumat',
		'Saturday' => 'Sabtu'
	);
	
	$listMonthIn = array(
		'January' => 'Januari',
		'February' => 'Februari',
		'March' => 'Maret',
		'April' => 'April',
		'May' => 'Mei',
		'June' => 'Juni',
		'July' => 'Juli',
		'August' => 'Agustus',
		'September' => 'September',
		'October' => 'Oktober',
		'November' => 'November',
		'December' => 'Desember'
	);
	
	$dayIn = $listDayIn[$dayEng];
	$monthIn = $listMonthIn[$dateString->format('F')];
	$_convertDate = $dayIn . ', ' . $dateString->format('d') . ' ' . $monthIn . ' ' . $dateString->format('Y');
	return $_convertDate;
}


function dateToDM($initial_date, $listMonthIn = array(
	'January' => 'Januari',
	'February' => 'Februari',
	'March' => 'Maret',
	'April' => 'April',
	'May' => 'Mei',
	'June' => 'Juni',
	'July' => 'Juli',
	'August' => 'Agustus',
	'September' => 'September',
	'October' => 'Oktober',
	'November' => 'November',
	'December' => 'Desember'
)) {

$date = new DateTime($initial_date);
$date->add(new DateInterval('P68D'));
$formatted_date = $date->format('d ') . $listMonthIn[$date->format('F')];

return $formatted_date;
}




function downloadFile($file) {
	if (isset($file)) {
		$fileName = basename($file);
		$filePath = '../images/download/' . $fileName; 
		
		if (file_exists($filePath)) {
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $fileName . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filePath));

			readfile($filePath);

			// Lakukan peningkatan jumlah unduhan pada database
			$query = "UPDATE pub_files SET files_down = files_down + 1 WHERE files_nm = '$fileName'";
			$mysqli->query($query);

			exit;
		} else {
			echo "File not found.";
		}
	} else {
		echo "Invalid request.";
	}
}


function openPDFInNewTab($pdfFilePath) {
	if (file_exists($pdfFilePath)) {
		$token = uniqid();
		return '<a class="btn btn-outline-primary" href="' . $pdfFilePath . '?token=' . $token . '" target="_blank">LHKPN</a>';
	}
}


?>