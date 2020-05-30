<!-- Page map as a page nav in the top right corner -->
	<canvas id="pagemap" class="article"></canvas>
	<!-- /pagemap -->
	<!-- Header -->
	<header class="article-header container-fluid" style="background-image: url('<?php echo (isset($img['header']) && !empty($img['header'])) ? $img['header']['url']: '/includes/test/assets/Moofushi_Kandu_fish.jpg'; ?>');">
		<div class="row">
			<div class="col-sm-5 wrapper">
				<div class="subtitle">Where is my ride?</div>
				<div class="title">Trains <?php $this->load->view('helpers/menu-fieldnotes'); ?></div>
			</div>
			<div class="col-sm-7"></div>
		</div>
	</header>
	<!-- Header -->
	<!-- Article -->
	<article class="article-article">
		<div class="container-fluid">
			<div class="row text-center">
				<div class="d-none d-sm-block col-sm"></div>
				<header class="col-sm-10 col-lg-6">
					<div class="subtitle" data-editable="" data-name="payload[blogtype]"><p><?=$blogtype?></p></div>
					<div data-editable="" data-name="payload[title]"><h1><?=$title?></h1></div><!-- (<?=$id?>)-->
					<div class="excerpt" data-editable="" data-name="payload[excerpt]"><p><?=$this->shared->handlebar_links($excerpt)?></p></div>
				</header>
				<div class="d-none d-sm-block col-sm"></div>
			</div>
			<div class="row">
				<div class="col-md d-none d-lg-block"></div>
				<div class="col-md-5 col-lg-4 text-right ">
					<aside>
						<p class="meta">This article was published <br><?php echo $this->shared->twitterdate($timestamp, true); ?> by <?php echo $author; ?>.</p>
					</aside>
				</div>
				<div class="col-md-7 col-lg-6">
					<div class="body" data-editable="" data-name="payload[body]">
						<?php echo $this->shared->handlebar_links($body); ?></p>
					</div>
										<?php 
											$station = ($this->input->get('station')) ? $this->input->get('station', TRUE): "PDX";
											$stationdepartures_legacy = $this->shared->get_curl('https://asm.transitdocs.com/api/stationDepartures.php?station='.$station, true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36');
											/*
											
											
											$amtrakdata = $this->shared->get_curl('https://amtk.carto.com/api/v2/sql?q=SELECT%20*,%20ST_X(the_geom)%20AS%20lon,%20ST_Y(the_geom)%20AS%20lat%20FROM%20amtk.vall_ttm_trains&api_key=bac8df5ef273de9fc3132b053f03513326f65531', true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36');
											// https://amtk.carto.com/api/v2/sql?q=SELECT *, ST_X(the_geom) AS lon, ST_Y(the_geom) AS lat FROM amtk.vall_ttm_trains&api_key=bac8df5ef273de9fc3132b053f03513326f65531
											$amtrakevents = array();
											$amtraktrains = array();
											$stationdepartures = array();
											foreach ($amtrakdata['rows'] as $key => $row) {
												//print_r($row);
												if ($row['showmarker'] == 'N') continue;
												for ($i = 1; $i <= 40; $i++) {
													$_s = 'station'.$i;
													if (!empty($row[$_s]) && $row[$_s] != 'null') {
														$event = (array)json_decode($row[$_s]);
														//echo '<pre>';print_r($event);die;
														$amtrakevents[$event['code']] = array(
															'train' => $row['cartodb_id'],
															'show' => $row['showmarker'],
															'code' => $event['code'], // RNO
															'tz' => $event['tz'], // 'P',
															'bus' => $event['bus'], // false,
															'scharr' => (isset($event['scharr'])) ? strtotime($event['scharr']) : false, // '02/20/2019 17:35:00',
															'schdep' => (isset($event['schdep'])) ? strtotime($event['schdep']) : false, // '02/20/2019 17:35:00',
															'schcmnt' => $event['schcmnt'], // '',
															'autoarr' => $event['autoarr'], // false,
															'autodep' => $event['autodep'], // false,
															'postarr' => (isset($event['postarr'])) ? strtotime($event['postarr']) : false, // '02/20/2019 17:35:00',
															'postdep' => (isset($event['postdep'])) ? strtotime($event['postdep']) : false, // '02/20/2019 17:49:00',
															'postcmnt' => (isset($event['postcmnt'])) ? $event['postcmnt'] : false, // '1 HR 43 MI LATE'
															'estarr' => (isset($event['estarr'])) ? strtotime($event['estarr']) : false, // '02/20/2019 17:35:00',
															'estdep' => (isset($event['estdep'])) ? strtotime($event['estdep']) : false, // '02/20/2019 17:49:00',
															'estarrcmnt' => (isset($event['estarrcmnt'])) ? $event['estarrcmnt'] : false, // '1 HR 43 MI LATE'
															'estarrcmnt' => (isset($event['estarrcmnt'])) ? $event['estarrcmnt'] : false, // '1 HR 43 MI LATE'
														);
														$stationevent = false;
														// event station (where the train is right now)
														if ($event['code'] == $station) {
															$eventstation = $amtrakevents[$station];
														}
						
														// current station (station set by user)
														if ($event['code'] == $row['eventcode']) {
															$currentstation = $amtrakevents[$station];
															$stationdepartures[] = $amtrakevents[$station];
														}
													}
												}
												$amtraktrains[$row['cartodb_id']] = array(
													// train details
													"id" => $row['cartodb_id'],					// 1234567
													"show" => $row['showmarker'],					// 1234567
													"number" => $row['trainnum'],				// 6
													"name" => $row['routename'],				// California Zephyr
													"is_enroute" => ($row['trainstate'] == 'Active') ? 1 : $row['trainstate'],		// 1
													"is_live" => $row['trainstate'],			// 1
													"message" => $row['statusmsg'],				// SERVICE DISRUPTION
					
													// origin
													"or_date" => $row['origschdep'], 			// 20190214
													"origin_code" => $row['origcode'],			// EMY
													"origin" => $row['origcode'],				// Emeryville, CA ** ONLY A STATION CODE RIGHT NOW
														//"origin" => $row['trainnum'],			// Emeryville, CA
					
													// destination
													"destination_code" => $row['destcode'],		// CHI
													"destination" => $row['destcode'],			// CHI  ** ONLY A STATION CODE RIGHT NOW
														//"destination" => $row['trainnum'],	// Chicago, IL Union Station
					
					
													// event station (where the train is right now)
													"otp_loc" => $row['eventcode'],				// Green River, UT ** ONLY A STATION CODE RIGHT NOW
													"est_dep" => ($eventstation['estdep']) ? date("g:i a",$eventstation['estdep']) : date("g:i a",$eventstation['postdep']),		// 12:11AM
													"edep_otp" => ($eventstation['estdep']) ? $this->shared->twitterdate($eventstation['estdep']) : $this->shared->twitterdate($eventstation['postdep']),		// -301
													"est_arr" => ($eventstation['estarr']) ? date("g:i a",$eventstation['estarr']) : date("g:i a",$eventstation['postarr']),		// 11:49PM
													"earr_otp" => ($eventstation['estarr']) ? $this->shared->twitterdate($eventstation['estarr']) : $this->shared->twitterdate($eventstation['postarr']),		// -311
													"otp_type" => ($eventstation['estdep']) ? 'arr' : 'dep',		// dep
													//	"otp" => $eventstation['trainnum'],			// -401
													"otp" => ($eventstation['estdep']) ? date("g:i a",$eventstation['estdep']) : date("g:i a",$eventstation['postdep']),		// 12:11AM
													"eventstation" => $eventstation,
					
					
													// live status
													"loc_update_time" => $row['updated_at'],	//2:45PM M
													"lat" => $row['lat'],						// 38.982810974
													"lon" => $row['lon'],						// -110.128196716
													"heading" => $row['heading'],				// E
													"speed" => $row['velocity'],				// 61.1
					
					
													// current station (station set by user)
													"sch_dep" => ($currentstation['estdep']) ? date("g:i a",$currentstation['estdep']) : date("g:i a",$currentstation['postdep']),		// 12:11AM
													"sch_dep_time" => ($currentstation['estdep']) ? $this->shared->twitterdate($currentstation['estdep']) : $this->shared->twitterdate($currentstation['postdep']),		// -301
													"sch_arr" => ($currentstation['estarr']) ? date("g:i a",$currentstation['estarr']) : date("g:i a",$currentstation['postarr']),		// 11:49PM
													"sch_arr_time" => ($currentstation['estarr']) ? $this->shared->twitterdate($currentstation['estarr']) : $this->shared->twitterdate($currentstation['postarr']),		// -311
													"local_date" => date("g:i a",$currentstation['schdep']),		// 12:11AM
													"currentstation" => $currentstation,
					
													// other
														//"thresh" => $row['trainnum'],			// 30
														//"miles" => $row['trainnum'],			// 2438
												);
												echo '<pre>';print_r($amtraktrains);echo '</pre>';
												
											}
											$_deps = $stationdepartures;
											$stationdeparturesXXX = array(
												'name' => '',	// Essex, MT
												'subname' => '', //
												'tz' => '', // MT
												'lat' => '', // 48.275543
												'lon' => '', // -113.610942
												'local_time' => '', // 11:41am MT March 4, 2019
												'update_time' => '', // 11:39am
												'age' => '', // 133
					
											);
											foreach ($_deps as $s) {
												//print_r ($stationdepartures['trains']);
											}
											
											//echo '<pre>';
											//print_r($amtraktrains);
											//echo '</pre>';
					?>
					<?php /*        (
								[0] => Array
									(
										[number] => 6									d
										[or_date] => 20190214							
										[local_date] => 2/15							
										[sch_dep] => 7:10PM								
										[sch_arr] => 6:38PM								
										[name] => California Zephyr						
										[is_enroute] => 1								
										[is_live] => 1									
										[destination] => Chicago, IL Union Station		
										[origin] => Emeryville, CA						
										[destination_code] => CHI						destcode: {type: "string"}
										[origin_code] => EMY
										[miles] => 2438
										[otp] => -401
										[otp_loc] => Green River, UT
										[otp_type] => dep
										[lat] => 38.982810974
										[lon] => -110.128196716
										[speed] => 61.1
										[heading] => E
										[loc_update_time] => 2:45PM M
										[message] => 
										[est_dep] => 12:11AM
										[edep_otp] => -301
										[est_arr] => 11:49PM
										[earr_otp] => -311
										[thresh] => 30
					
					aliases: ""
					cartodb_id: 389485
					cmsid: "1237608341980"
					created_at: null
					destcode: "CHI"
					eventcode: "FMG"
					eventdt: ""
					eventschar: ""
					eventschdp: ""
					eventt: null
					eventtz: null
					gx_id: 813548
					heading: "NE"
					id: "813548"
					lastvalts: "2/21/2019 10:15:49 PM"
					origcode: "EMY"
					origintz: "P"
					origschdep: "2/20/2019 9:10:00 AM"
					routename: "California Zephyr"
					showmarker: "Y"
					station1: "
									{
									"code":"RNO",
									"tz":"P",
									"bus":false,
									"scharr":"02/20/2019 15:56:00",
									"schdep":"02/20/2019 16:06:00",
									"schcmnt":"",
									"autoarr":false,
									"autodep":false,
									"postarr":"02/20/2019 17:35:00",
									"postdep":"02/20/2019 17:49:00",
									"postcmnt":"1 HR 43 MI LATE"
									}"
					station2: "{"code":"RIC","tz":"P","bus":false,"schdep":"02/20/2019 09:22:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 09:19:00","postdep":"02/20/2019 09:23:00","postcmnt":"1 MI LATE"}"
					station3: "{"code":"MTZ","tz":"P","bus":false,"schdep":"02/20/2019 09:54:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 09:49:00","postdep":"02/20/2019 09:58:00","postcmnt":"4 MI LATE"}"
					station4: "{"code":"DAV","tz":"P","bus":false,"schdep":"02/20/2019 10:36:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 10:53:00","postdep":"02/20/2019 10:57:00","postcmnt":"21 MI LATE"}"
					station5: "{"code":"SAC","tz":"P","bus":false,"scharr":"02/20/2019 10:58:00","schdep":"02/20/2019 11:09:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 11:13:00","postdep":"02/20/2019 11:24:00","postcmnt":"15 MI LATE"}"
					station6: "{"code":"RSV","tz":"P","bus":false,"schdep":"02/20/2019 11:35:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 11:46:00","postdep":"02/20/2019 11:53:00","postcmnt":"18 MI LATE"}"
					station7: "{"code":"COX","tz":"P","bus":false,"schdep":"02/20/2019 12:21:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 12:39:00","postdep":"02/20/2019 12:44:00","postcmnt":"23 MI LATE"}"
					station8: "{"code":"TRU","tz":"P","bus":false,"schdep":"02/20/2019 14:38:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 16:30:00","postdep":"02/20/2019 16:39:00","postcmnt":"2 HR 1 MI LATE"}"
					station9: "{"code":"RNO","tz":"P","bus":false,"scharr":"02/20/2019 15:56:00","schdep":"02/20/2019 16:06:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 17:35:00","postdep":"02/20/2019 17:49:00","postcmnt":"1 HR 43 MI LATE"}"
					station10: "{"code":"WNN","tz":"P","bus":false,"schdep":"02/20/2019 19:08:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 20:37:00","postdep":"02/20/2019 20:48:00","postcmnt":"1 HR 40 MI LATE"}"
					station11: "{"code":"ELK","tz":"P","bus":false,"schdep":"02/20/2019 21:31:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/20/2019 22:47:00","postdep":"02/20/2019 22:50:00","postcmnt":"1 HR 19 MI LATE"}"
					station12: "{"code":"SLC","tz":"M","bus":false,"scharr":"02/21/2019 03:05:00","schdep":"02/21/2019 03:30:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 04:47:00","postdep":"02/21/2019 05:20:00","postcmnt":"1 HR 50 MI LATE"}"
					station13: "{"code":"PRO","tz":"M","bus":false,"schdep":"02/21/2019 04:35:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 06:15:00","postdep":"02/21/2019 06:18:00","postcmnt":"1 HR 43 MI LATE"}"
					station14: "{"code":"HER","tz":"M","bus":false,"schdep":"02/21/2019 06:37:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 08:32:00","postdep":"02/21/2019 08:34:00","postcmnt":"1 HR 57 MI LATE"}"
					station15: "{"code":"GRI","tz":"M","bus":false,"schdep":"02/21/2019 07:59:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 10:12:00","postdep":"02/21/2019 10:14:00","postcmnt":"2 HR 15 MI LATE"}"
					station16: "{"code":"GJT","tz":"M","bus":false,"scharr":"02/21/2019 10:11:00","schdep":"02/21/2019 10:23:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 12:10:00","postdep":"02/21/2019 12:22:00","postcmnt":"1 HR 59 MI LATE"}"
					station17: "{"code":"GSC","tz":"M","bus":false,"scharr":"02/21/2019 12:04:00","schdep":"02/21/2019 12:10:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 14:24:00","postdep":"02/21/2019 14:36:00","postcmnt":"2 HR 26 MI LATE"}"
					station18: "{"code":"GRA","tz":"M","bus":false,"schdep":"02/21/2019 15:12:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 17:34:00","postdep":"02/21/2019 17:35:00","postcmnt":"2 HR 23 MI LATE"}"
					station19: "{"code":"WIP","tz":"M","bus":false,"schdep":"02/21/2019 15:50:00","schcmnt":"","autoarr":false,"autodep":false,"postarr":"02/21/2019 17:58:00","postdep":"02/21/2019 18:05:00","postcmnt":"2 HR 15 MI LATE"}"
					station20: "{
									"code":"DEN",
									"tz":"M",
									"bus":false,
									"scharr":"02/21/2019 18:38:00",
									"schdep":"02/21/2019 19:10:00",
									"schcmnt":"",
									"autoarr":false,
									"autodep":false,
									"postarr":"02/21/2019 20:17:00",
									"postdep":"02/21/2019 20:55:00",
									"postcmnt":"1 HR 45 MI LATE"}"
					
					station21: "{
									"code":"FMG",
									"tz":"M",
									"bus":false,
									"schdep":"02/21/2019 20:25:00",
									"schcmnt":"",
									"autoarr":false,
									"autodep":true,
									"estarr":"02/21/2019 22:30:00",
									"estdep":"02/21/2019 22:31:00",
									"estarrcmnt":"02 HR 05 MI LATE",
									"estdepcmnt":"02 HR 06 MI LATE"}"
					
					station22: "{"code":"MCK","tz":"C","bus":false,"schdep":"02/21/2019 23:49:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 01:50:00","estdep":"02/22/2019 01:52:00","estarrcmnt":"02 HR 01 MI LATE","estdepcmnt":"02 HR 03 MI LATE"}"
					station23: "{"code":"HLD","tz":"C","bus":false,"schdep":"02/22/2019 00:54:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 02:55:00","estdep":"02/22/2019 02:56:00","estarrcmnt":"02 HR 01 MI LATE","estdepcmnt":"02 HR 02 MI LATE"}"
					station24: "{"code":"HAS","tz":"C","bus":false,"schdep":"02/22/2019 01:42:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 03:41:00","estdep":"02/22/2019 03:43:00","estarrcmnt":"01 HR 59 MI LATE","estdepcmnt":"02 HR 01 MI LATE"}"
					station25: "{"code":"LNK","tz":"C","bus":false,"scharr":"02/22/2019 03:20:00","schdep":"02/22/2019 03:26:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 05:14:00","estdep":"02/22/2019 05:17:00","estarrcmnt":"01 HR 54 MI LATE","estdepcmnt":"01 HR 51 MI LATE"}"
					station26: "{"code":"OMA","tz":"C","bus":false,"scharr":"02/22/2019 04:59:00","schdep":"02/22/2019 05:14:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 06:22:00","estdep":"02/22/2019 06:32:00","estarrcmnt":"01 HR 23 MI LATE","estdepcmnt":"01 HR 18 MI LATE"}"
					station27: "{"code":"CRN","tz":"C","bus":false,"schdep":"02/22/2019 07:04:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 08:19:00","estdep":"02/22/2019 08:21:00","estarrcmnt":"01 HR 15 MI LATE","estdepcmnt":"01 HR 17 MI LATE"}"
					station28: "{"code":"OSC","tz":"C","bus":false,"schdep":"02/22/2019 07:40:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 08:52:00","estdep":"02/22/2019 08:54:00","estarrcmnt":"01 HR 12 MI LATE","estdepcmnt":"01 HR 14 MI LATE"}"
					station29: "{"code":"OTM","tz":"C","bus":false,"scharr":"02/22/2019 09:00:00","schdep":"02/22/2019 09:09:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 10:09:00","estdep":"02/22/2019 10:14:00","estarrcmnt":"01 HR 09 MI LATE","estdepcmnt":"01 HR 05 MI LATE"}"
					station30: "{"code":"MTP","tz":"C","bus":false,"schdep":"02/22/2019 09:54:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 10:55:00","estdep":"02/22/2019 10:57:00","estarrcmnt":"01 HR 01 MI LATE","estdepcmnt":"01 HR 03 MI LATE"}"
					station31: "{"code":"BRL","tz":"C","bus":false,"schdep":"02/22/2019 10:36:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 11:27:00","estdep":"02/22/2019 11:28:00","estarrcmnt":"51 MI LATE","estdepcmnt":"52 MI LATE"}"
					station32: "{"code":"GBB","tz":"C","bus":false,"schdep":"02/22/2019 11:41:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 12:11:00","estdep":"02/22/2019 12:13:00","estarrcmnt":"30 MI LATE","estdepcmnt":"32 MI LATE"}"
					station33: "{"code":"PCT","tz":"C","bus":false,"schdep":"02/22/2019 12:33:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 13:01:00","estdep":"02/22/2019 13:02:00","estarrcmnt":"28 MI LATE","estdepcmnt":"29 MI LATE"}"
					station34: "{"code":"NPV","tz":"C","bus":false,"schdep":"02/22/2019 13:53:00","schcmnt":"","autoarr":true,"autodep":true,"estarr":"02/22/2019 14:12:00","estdep":"02/22/2019 14:13:00","estarrcmnt":"19 MI LATE","estdepcmnt":"20 MI LATE"}"
					station35: "{"code":"CHI","tz":"C","bus":false,"scharr":"02/22/2019 14:50:00","schcmnt":"","autoarr":true,"autodep":false,"estarr":"02/22/2019 14:50:00","estarrcmnt":"ON TIME"}"
					station36: null
					station37: null
					station38: null
					station39: null
					station40: null
					statusmsg: ""
					the_geom: "0101000020E61000007D5E0000B1085AC06E3AFFFF0A1A4440"
					the_geom_webmercator: "0101000020110F000015FCD112531C66C120954435D0AC5241"
					trainnum: "6"
					trainstate: "Active"
					updated_at: "2019-02-22T00:00:00Z"
					velocity: "78.4546737670898"
					viewstn1: null
					viewstn2: null<?php /**/ 
					
					
					$stationdepartures = $stationdepartures_legacy;
					?>
										<div class="row">
											<div class="col-lg-2">
												<h1 style="text-transform: uppercase;"><?php echo $station; ?></h1>
											</div>
											<div class="col-lg-8">
												<h3><?php echo count($stationdepartures['trains']); ?> departures from <?php echo $stationdepartures['name']; ?> today.</h3>
												<p><?php echo $stationdepartures['subname']; ?> in <?php echo $stationdepartures['name']; ?></p>
											</div>
										</div>
										
										<?php if (count($stationdepartures['trains'] > 0)) foreach($stationdepartures['trains'] as $train) { if ($train['is_enroute'] == '1') { ;?>
					
										<hr />
										<div class="row">
											<div class="col-lg-4">
												<h1>🚂 <?php $this->shared->nicevar($train,'name'); ?></h1>
												<h3><?php $this->shared->nicevar($train,'number'); ?></h3>
												<h4><?php $this->shared->nicevar($train,'origin'); ?> ➡ <?php $this->shared->nicevar($train,'destination'); ?></h4>
												<?php $this->shared->nicevar($train,'local_date','<p>','</p>'); ?>
											</div>
											<div class="col-lg-8">
												<h3>
													<?php if (isset($train['earr_otp'])) {
														if ($train['earr_otp'] == 0) { 
															echo 'Likely on time';
														} else {
															echo str_replace('-','',$train['earr_otp']).' minutes ';
															echo ($train['earr_otp'] > 0) ? 'early': 'late (shoot! 😦)';
														}
													} elseif (isset($train['edep_otp'])) {
														if ($train['edep_otp'] == 0) { 
															echo 'Likely on time';
														} else {
															echo 'Estimated to depart '.str_replace('-','',$train['edep_otp']).' minutes ';
															echo ($train['edep_otp'] > 0) ? 'early': 'late (shoot! 😦)';
														}
													} else {
														echo 'Not yet departed.';
													} ?>
												</h3>
												<div class="">
													<div class="pull-left" style="padding-right: 5%;">
														<p><strong>Arrival</strong></p>
														<p><?php $this->shared->nicevar($train,'sch_arr','<i>','</i><br>'); $this->shared->nicevar($train,'est_arr','',' estimated'); ?></p>
														
													</div>
													<div class="pull-left" style="padding-right: 5%;">
														<p><strong>Departs</strong></p>
														<p><?php $this->shared->nicevar($train,'sch_dep','<i>','</i><br>'); $this->shared->nicevar($train,'est_dep','',' estimated'); ?></p>
													</div>
													<div class="pull-left">
														<p>
															<?php if (isset($train['otp'])) { 
																if ($train['otp'] == 0) { 
																	echo '<strong>Currently on time';
																	echo ($train['otp_type'] == 'dep') ? ' out of ': ' in to ';
																	$this->shared->nicevar($train,'otp_loc');
																	echo '</strong><br />';
																} else {
																	echo "<strong>Currently ".str_replace('-','',$train['otp']).' minutes ';
																	echo ($train['otp'] > 0) ? 'early': 'late';
																	echo ($train['otp_type'] == 'dep') ? ' out of ': ' in to ';
																	$this->shared->nicevar($train,'otp_loc');
																	echo '</strong><br />';
																}
															} else {
																echo 'No current data to share.';
															} ?>
															<?php $this->shared->nicevar($train,'heading','Headed '); $this->shared->nicevar($train,'speed',' at '," mph, "); $this->shared->nicevar($train,'loc_update_time',' last updated '); ?>
														</p>
														<p><a href="#">🗺See a map</a>, <a href="#">⏱details</a>, or <a href="#">💽history</a><?php $this->shared->nicevar($train,'message','<br>',''); ?></p>
													</div>
												</div>
											</div>
										</div>
					
										<?php }; }; ?>					
										<hr />
										<p><a href="#" onclick="$('#trainssource').toggle(); return false;">Want to see the raw source?</a></p>
										<pre id="trainssource" style="display: none;"><?php print_r($stationdepartures); ?></pre>
						<?php $this->shared->footer_photocitation($id,$img,$timestamp,$slug,$title); ?>
				</div>
				<div class="col-md d-none d-lg-block"></div>
			</div>
		</div>
	</article>
	<!-- /Article -->
	<?php if ($this->ion_auth->logged_in()) { ?>
	<!-- Off canvas -->
	<div class="offcanvaspane">
		<div class="container">
			<!-- Main nav tabs in the bottom left corner -->
			<nav id="editornav" class="inlinetabs">
				<a class="sectiontitle" onclick="$('body').removeClass('offcanvas'); return false;">Editor</a>
				<ul class="nav nav-tabs" id="offcanvastabs" role="tablist">
					<li class="nav-item" role="presentation"><a class="nav-link active" id="editor-edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">Page</a></li> 
					<li class="nav-item" role="presentation"><a class="nav-link" id="editor-img-tab" data-toggle="tab" href="#editimg" role="tab" aria-controls="editimg" aria-selected="false">Header Image</a></li> 
					<li class="nav-item" role="presentation"><a class="nav-link" id="editor-new-tab" data-toggle="tab" href="#editnew" role="tab" aria-controls="editnew" aria-selected="false">+ New</a></li> 
				</ul>
				<div class="tab-content" id="offcanvaspanes">
					<div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="editor-edit-tab">
					<!-- Start Page Editor Tab -->
					<form id="formeditor" >
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[title]" value="<?=$title?>">
							<label for="payload[title]">Page Title</label>
						</div>
						<div class="form-label-group">
							<textarea type="text" class="form-control" placeholder="Excerpt" required="" autocomplete="off" name="payload[excerpt]"><?=$excerpt?></textarea>
							<label for="payload[excerpt]">Excerpt</label>
						</div>
						<div class="form-label-group">
							<select name="payload[template]" class="form-control">
								<?php foreach (get_filenames("./application/views/app/pages") as $pagetemplate) { $pagetemplate = str_replace('.php', '', $pagetemplate); ?>
								<option value="<?php echo $pagetemplate; ?>"<?php if ($pagetemplate == $template) { ?> selected="selected"<?php } ?>><?php echo ucfirst($pagetemplate); ?></option>
								<?php } ?>
							</select>
							<label for="payload[template]">Page Template</label>
						</div>
						<div class="form-label-group">
							<select name="payload[pagetype]" class="form-control">
								<?php foreach (array('page','blog') as $__pagetype) { ?>
								<option value="<?php echo $__pagetype; ?>"<?php if ($__pagetype == $pagetype) { ?> selected="selected"<?php } ?>><?php echo ucfirst($__pagetype); ?></option>
								<?php } ?>
							</select>
							<label for="payload[pagetype]">Page Type</label>
						</div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[blogtype]" value="<?=$blogtype?>">
							<label for="payload[blogtype]">Blog Type</label>
						</div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Page Title" required="" autocomplete="off" name="payload[author]" value="<?=$author?>">
							<label for="payload[author]">Author</label>
						</div>
						<div class="">
							<label for="payload[relationships][definition][]">Definitions</label>
							<select name="payload[relationships][definition][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List definitions
								$list = $this->shared->list_bytype('definition'); $relationships = array(); if ($set !== false) foreach ($set as $ss) $relationships[] = $ss['id'];
								if ($list === false) { echo '<option disabled>No definitions to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[relationships][taxonomy][]">Taxonomy</label>
							<select name="payload[relationships][taxonomy][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List taxonomy
								$list = $this->shared->list_bytype('taxonomy');
								if ($list === false) { echo '<option disabled>No taxonomy to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<div class="">
							<label for="payload[relationships][page][]">Pages</label>
							<select name="payload[relationships][page][]" class="selectpicker form-control" data-width="100%" data-live-search="true" data-size="5" multiple data-selected-text-format="count > 4">
							<?php // List taxonomy
								$list = $this->shared->list_bytype('page');
								if ($list === false) { echo '<option disabled>No pages to display.</option>'; } else {
								foreach ($list as $a) { $selected = (in_array($a['id'],$relationships)) ? ' selected' : ''; echo '<option value="'.$a['id'].'"'.$selected.'>'.$a['title']."</option>\n"; }} ?> 
							</select>
						</div>
						<br />
						<hr>
						<div id="editorfail" class="alert alert-danger " style="display: none;" role="alert">Uh oh, the <?php echo $type; ?> didn't save, make sure everything above is filled and try again.</div>
						<div id="editorsuccess" class="alert alert-success " style="display: none;" role="alert">Great success, content posted.</div>
						<div id="editorloading" class="alert alert-info progress-bar progress-bar-striped active" style="display: block; width: 100%; display: none;" role="alert">working...</div>
						<div id="editorbuttons" class="offcanvasbuttons">
							<a class="btn btn-danger pull-right" href="#" data-toggle="modal" data-target="#deletemodal">Delete</a>
							<button type="button" class="btn btn-primary tt" id="submiteditor">Save</button>
							<button type="reset" class="btn btn-default" >Reset</button>
						</div>
						<p>Body Content</p>
						<div class=""><textarea type="text" class="cas-summernote" id="cas-def-body" name="payload[body]"><?php echo $body; ?></textarea></div>
						<div class="form-label-group">
							<input type="text" class="form-control" placeholder="Link/Slug" required="" autocomplete="off" name="payload[slug]" value="<?=$slug?>">
							<label for="payload[slug]">Slug</label>
						</div>
					</form>
					<!-- End Page Editor Tab -->
					</div>
					<div class="tab-pane fade" id="editimg" role="tabpanel" aria-labelledby="editor-img-tab">
					<?php $this->load->view('helpers/editor-headerimage'); ?> 
					</div>
					<div class="tab-pane fade" id="editnew" role="tabpanel" aria-labelledby="editor-new-tab">
					<!-- Start New Content Tab -->
					<?php $this->load->view('helpers/editor-new'); ?> 
					<!-- End New Content Tab -->
					</div>
				</div>
			</nav>
			<!-- /main nav -->
		</div>
	</div>
	<!-- /Off canvas -->
	<?php } ?>
	<!-- Modal -->
	<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">You are about to delete this page.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Just kidding, close</button>
					<a href="/api/remove/page/<?php echo $id; ?>/home" class="btn btn-danger">Delete this page</a>
				</div>
			</div>
		</div>
	</div>
	<?php if ($this->ion_auth->logged_in() && isset($loadjs['contenttools'])) { 
		$this->load->view("helpers/contenttools");
		$this->load->view("helpers/editor-scripts");
	} ?> 
	<script>
		//pagemap(document.querySelector('#pagemap'));
		pagemap(document.querySelector('#pagemap'), {
			viewport: null,
			styles: {
				'.title,nav,p': 'rgba(0,0,0,0.08)',
				'h1,a': 'rgba(0,0,0,0.10)',
				'h2,h3,h4': 'rgba(0,0,0,0.08)',
			},
			back: 'rgba(0,0,0,0.02)',
			view: 'rgba(0,0,0,0.05)',
			drag: 'rgba(0,0,0,0.10)',
			interval: null,
		});
	</script>
