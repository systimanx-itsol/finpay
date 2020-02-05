<template>
   <section class="hero is-fullheight is-default is-bold">
      <layout-header></layout-header>
      <div class="container breadcrums1">
      <h6 class="form-name is-uppercase is-pulled-left is-size-6">System Settings</h6>

      <!-- <nav class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
        <ul>
          <li class="is-size-7">
            <a class="has-text-grey" href="#">Pages</a>
          </li>

          <li class="is-size-7 is-active">
            <a class href="#" aria-current="page">Tax Rates</a>
          </li>
        </ul>
      </nav> -->
    </div>
      <section class="container forms-sec has-background-white box">
         <form id="app" @submit.prevent="save" validate>
            <div class="columns">
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Language <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="language" id="language" v-model="system.language" v-validate="'required'">
                                 <option selected value="English">English</option>
                                 <!-- <option value=""></option> -->
                              </select>
                            </div>
                        </div>
                        <span v-show="errors.has('language')" class="invalid-feedback">{{languageError}}</span>
                  </div>
               </p>
                  <p class="bd-notification is-info">
                     <label>Timezone <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="timezone" id="timezone" v-model="system.timezone" v-validate="'required'">
                                 <option selected value="Africa/Abidjan">Africa/Abidjan</option>
                                 <option value="Africa/Accra">Africa/Accra</option>
                                 <option value="Africa/Addis_Ababa">Africa/Addis_Ababa</option>
                                 <option value="Africa/Algiers">Africa/Algiers</option>
                                 <option value="Africa/Asmara">Africa/Asmara</option>
                                 <option value="Africa/Bamako">Africa/Bamako</option>
                                 <option value="Africa/Bangui">Africa/Bangui</option>
                                 <option value="Africa/Banjul">Africa/Banjul</option>
                                 <option value="Africa/Bissau">Africa/Bissau</option>
                                 <option value="Africa/Blantyre">Africa/Blantyre</option>
                                 <option value="Africa/Brazzaville">Africa/Brazzaville</option>
                                 <option value="Africa/Bujumbura">Africa/Bujumbura</option>
                                 <option value="Africa/Cairo">Africa/Cairo</option>
                                 <option value="Africa/Casablanca">Africa/Casablanca</option>
                                 <option value="Africa/Ceuta">Africa/Ceuta</option>
                                 <option value="Africa/Conakry">Africa/Conakry</option>
                                 <option value="Africa/Dakar">Africa/Dakar</option>
                                 <option value="Africa/Dar_es_Salaam">Africa/Dar_es_Salaam</option>
                                 <option value="Africa/Djibouti">Africa/Djibouti</option>
                                 <option value="Africa/Douala">Africa/Douala</option>
                                 <option value="Africa/El_Aaiun">Africa/El_Aaiun</option>
                                 <option value="Africa/Freetown">Africa/Freetown</option>
                                 <option value="Africa/Gaborone">Africa/Gaborone</option>
                                 <option value="Africa/Harare">Africa/Harare</option>
                                 <option value="Africa/Johannesburg">Africa/Johannesburg</option>
                                 <option value="Africa/Juba">Africa/Juba</option>
                                 <option value="Africa/Kampala">Africa/Kampala</option>
                                 <option value="Africa/Khartoum">Africa/Khartoum</option>
                                 <option value="Africa/Kigali">Africa/Kigali</option>
                                 <option value="Africa/Kinshasa">Africa/Kinshasa</option>
                                 <option value="Africa/Lagos">Africa/Lagos</option>
                                 <option value="Africa/Libreville">Africa/Libreville</option>
                                 <option value="Africa/Lome">Africa/Lome</option>
                                 <option value="Africa/Luanda">Africa/Luanda</option>
                                 <option value="Africa/Lubumbashi">Africa/Lubumbashi</option>
                                 <option value="Africa/Lusaka">Africa/Lusaka</option>
                                 <option value="Africa/Malabo">Africa/Malabo</option>
                                 <option value="Africa/Maputo">Africa/Maputo</option>
                                 <option value="Africa/Maseru">Africa/Maseru</option>
                                 <option value="Africa/Mbabane">Africa/Mbabane</option>
                                 <option value="Africa/Mogadishu">Africa/Mogadishu</option>
                                 <option value="Africa/Monrovia">Africa/Monrovia</option>
                                 <option value="Africa/Nairobi">Africa/Nairobi</option>
                                 <option value="Africa/Ndjamena">Africa/Ndjamena</option>
                                 <option value="Africa/Niamey">Africa/Niamey</option>
                                 <option value="Africa/Nouakchott">Africa/Nouakchott</option>
                                 <option value="Africa/Ouagadougou">Africa/Ouagadougou</option>
                                 <option value="Africa/Porto-Novo">Africa/Porto-Novo</option>
                                 <option value="Africa/Sao_Tome">Africa/Sao_Tome</option>
                                 <option value="Africa/Tripoli">Africa/Tripoli</option>
                                 <option value="Africa/Tunis">Africa/Tunis</option>
                                 <option value="Africa/Windhoek">Africa/Windhoek</option>
                                 <option value="America/Adak">America/Adak</option>
                                 <option value="America/Anchorage">America/Anchorage</option>
                                 <option value="America/Anguilla">America/Anguilla</option>
                                 <option value="America/Antigua">America/Antigua</option>
                                 <option value="America/Araguaina">America/Araguaina</option>
                                 <option value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
                                 <option value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>
                                 <option value="America/Argentina/Cordoba">America/Argentina/Cordoba</option>
                                 <option value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>
                                 <option value="America/Argentina/La_Rioja">America/Argentina/La_Rioja</option>
                                 <option value="America/Argentina/Mendoza">America/Argentina/Mendoza</option>
                                 <option value="America/Argentina/Rio_Gallegos">America/Argentina/Rio_Gallegos</option>
                                 <option value="America/Argentina/Salta">America/Argentina/Salta</option>
                                 <option value="America/Argentina/San_Juan">America/Argentina/San_Juan</option>
                                 <option value="America/Argentina/San_Luis">America/Argentina/San_Luis</option>
                                 <option value="America/Argentina/Tucuman">America/Argentina/Tucuman</option>
                                 <option value="America/Argentina/Ushuaia">America/Argentina/Ushuaia</option>
                                 <option value="America/Aruba">America/Aruba</option>
                                 <option value="America/Asuncion">America/Asuncion</option>
                                 <option value="America/Atikokan">America/Atikokan</option>
                                 <option value="America/Bahia">America/Bahia</option>
                                 <option value="America/Bahia_Banderas">America/Bahia_Banderas</option>
                                 <option value="America/Barbados">America/Barbados</option>
                                 <option value="America/Belem">America/Belem</option>
                                 <option value="America/Belize">America/Belize</option>
                                 <option value="America/Blanc-Sablon">America/Blanc-Sablon</option>
                                 <option value="America/Boa_Vista">America/Boa_Vista</option>
                                 <option value="America/Bogota">America/Bogota</option>
                                 <option value="America/Boise">America/Boise</option>
                                 <option value="America/Cambridge_Bay">America/Cambridge_Bay</option>
                                 <option value="America/Campo_Grande">America/Campo_Grande</option>
                                 <option value="America/Cancun">America/Cancun</option>
                                 <option value="America/Caracas">America/Caracas</option>
                                 <option value="America/Cayenne">America/Cayenne</option>
                                 <option value="America/Cayman">America/Cayman</option>
                                 <option value="America/Chicago">America/Chicago</option>
                                 <option value="America/Chihuahua">America/Chihuahua</option>
                                 <option value="America/Costa_Rica">America/Costa_Rica</option>
                                 <option value="America/Creston">America/Creston</option>
                                 <option value="America/Cuiaba">America/Cuiaba</option>
                                 <option value="America/Curacao">America/Curacao</option>
                                 <option value="America/Danmarkshavn">America/Danmarkshavn</option>
                                 <option value="America/Dawson">America/Dawson</option>
                                 <option value="America/Dawson_Creek">America/Dawson_Creek</option>
                                 <option value="America/Denver">America/Denver</option>
                                 <option value="America/Detroit">America/Detroit</option>
                                 <option value="America/Dominica">America/Dominica</option>
                                 <option value="America/Edmonton">America/Edmonton</option>
                                 <option value="America/Eirunepe">America/Eirunepe</option>
                                 <option value="America/El_Salvador">America/El_Salvador</option>
                                 <option value="America/Fort_Nelson">America/Fort_Nelson</option>
                                 <option value="America/Fortaleza">America/Fortaleza</option>
                                 <option value="America/Glace_Bay">America/Glace_Bay</option>
                                 <option value="America/Godthab">America/Godthab</option>
                                 <option value="America/Goose_Bay">America/Goose_Bay</option>
                                 <option value="America/Grand_Turk">America/Grand_Turk</option>
                                 <option value="America/Grenada">America/Grenada</option>
                                 <option value="America/Guadeloupe">America/Guadeloupe</option>
                                 <option value="America/Guatemala">America/Guatemala</option>
                                 <option value="America/Guayaquil">America/Guayaquil</option>
                                 <option value="America/Guyana">America/Guyana</option>
                                 <option value="America/Halifax">America/Halifax</option>
                                 <option value="America/Havana">America/Havana</option>
                                 <option value="America/Hermosillo">America/Hermosillo</option>
                                 <option value="America/Indiana/Indianapolis">America/Indiana/Indianapolis</option>
                                 <option value="America/Indiana/Knox">America/Indiana/Knox</option>
                                 <option value="America/Indiana/Marengo">America/Indiana/Marengo</option>
                                 <option value="America/Indiana/Petersburg">America/Indiana/Petersburg</option>
                                 <option value="America/Indiana/Tell_City">America/Indiana/Tell_City</option>
                                 <option value="America/Indiana/Vevay">America/Indiana/Vevay</option>
                                 <option value="America/Indiana/Vincennes">America/Indiana/Vincennes</option>
                                 <option value="America/Indiana/Winamac">America/Indiana/Winamac</option>
                                 <option value="America/Inuvik">America/Inuvik</option>
                                 <option value="America/Iqaluit">America/Iqaluit</option>
                                 <option value="America/Jamaica">America/Jamaica</option>
                                 <option value="America/Juneau">America/Juneau</option>
                                 <option value="America/Kentucky/Louisville">America/Kentucky/Louisville</option>
                                 <option value="America/Kentucky/Monticello">America/Kentucky/Monticello</option>
                                 <option value="America/Kralendijk">America/Kralendijk</option>
                                 <option value="America/La_Paz">America/La_Paz</option>
                                 <option value="America/Lima">America/Lima</option>
                                 <option value="America/Los_Angeles">America/Los_Angeles</option>
                                 <option value="America/Lower_Princes">America/Lower_Princes</option>
                                 <option value="America/Maceio">America/Maceio</option>
                                 <option value="America/Managua">America/Managua</option>
                                 <option value="America/Manaus">America/Manaus</option>
                                 <option value="America/Marigot">America/Marigot</option>
                                 <option value="America/Martinique">America/Martinique</option>
                                 <option value="America/Matamoros">America/Matamoros</option>
                                 <option value="America/Mazatlan">America/Mazatlan</option>
                                 <option value="America/Menominee">America/Menominee</option>
                                 <option value="America/Merida">America/Merida</option>
                                 <option value="America/Metlakatla">America/Metlakatla</option>
                                 <option value="America/Mexico_City">America/Mexico_City</option>
                                 <option value="America/Miquelon">America/Miquelon</option>
                                 <option value="America/Moncton">America/Moncton</option>
                                 <option value="America/Monterrey">America/Monterrey</option>
                                 <option value="America/Montevideo">America/Montevideo</option>
                                 <option value="America/Montserrat">America/Montserrat</option>
                                 <option value="America/Nassau">America/Nassau</option>
                                 <option value="America/New_York">America/New_York</option>
                                 <option value="America/Nipigon">America/Nipigon</option>
                                 <option value="America/Nome">America/Nome</option>
                                 <option value="America/Noronha">America/Noronha</option>
                                 <option value="America/North_Dakota/Beulah">America/North_Dakota/Beulah</option>
                                 <option value="America/North_Dakota/Center">America/North_Dakota/Center</option>
                                 <option value="America/North_Dakota/New_Salem">America/North_Dakota/New_Salem</option>
                                 <option value="America/Ojinaga">America/Ojinaga</option>
                                 <option value="America/Panama">America/Panama</option>
                                 <option value="America/Pangnirtung">America/Pangnirtung</option>
                                 <option value="America/Paramaribo">America/Paramaribo</option>
                                 <option value="America/Phoenix" selected="selected">America/Phoenix</option>
                                 <option value="America/Port-au-Prince">America/Port-au-Prince</option>
                                 <option value="America/Port_of_Spain">America/Port_of_Spain</option>
                                 <option value="America/Porto_Velho">America/Porto_Velho</option>
                                 <option value="America/Puerto_Rico">America/Puerto_Rico</option>
                                 <option value="America/Punta_Arenas">America/Punta_Arenas</option>
                                 <option value="America/Rainy_River">America/Rainy_River</option>
                                 <option value="America/Rankin_Inlet">America/Rankin_Inlet</option>
                                 <option value="America/Recife">America/Recife</option>
                                 <option value="America/Regina">America/Regina</option>
                                 <option value="America/Resolute">America/Resolute</option>
                                 <option value="America/Rio_Branco">America/Rio_Branco</option>
                                 <option value="America/Santarem">America/Santarem</option>
                                 <option value="America/Santiago">America/Santiago</option>
                                 <option value="America/Santo_Domingo">America/Santo_Domingo</option>
                                 <option value="America/Sao_Paulo">America/Sao_Paulo</option>
                                 <option value="America/Scoresbysund">America/Scoresbysund</option>
                                 <option value="America/Sitka">America/Sitka</option>
                                 <option value="America/St_Barthelemy">America/St_Barthelemy</option>
                                 <option value="America/St_Johns">America/St_Johns</option>
                                 <option value="America/St_Kitts">America/St_Kitts</option>
                                 <option value="America/St_Lucia">America/St_Lucia</option>
                                 <option value="America/St_Thomas">America/St_Thomas</option>
                                 <option value="America/St_Vincent">America/St_Vincent</option>
                                 <option value="America/Swift_Current">America/Swift_Current</option>
                                 <option value="America/Tegucigalpa">America/Tegucigalpa</option>
                                 <option value="America/Thule">America/Thule</option>
                                 <option value="America/Thunder_Bay">America/Thunder_Bay</option>
                                 <option value="America/Tijuana">America/Tijuana</option>
                                 <option value="America/Toronto">America/Toronto</option>
                                 <option value="America/Tortola">America/Tortola</option>
                                 <option value="America/Vancouver">America/Vancouver</option>
                                 <option value="America/Whitehorse">America/Whitehorse</option>
                                 <option value="America/Winnipeg">America/Winnipeg</option>
                                 <option value="America/Yakutat">America/Yakutat</option>
                                 <option value="America/Yellowknife">America/Yellowknife</option>
                                 <option value="Antarctica/Casey">Antarctica/Casey</option>
                                 <option value="Antarctica/Davis">Antarctica/Davis</option>
                                 <option value="Antarctica/DumontDUrville">Antarctica/DumontDUrville</option>
                                 <option value="Antarctica/Macquarie">Antarctica/Macquarie</option>
                                 <option value="Antarctica/Mawson">Antarctica/Mawson</option>
                                 <option value="Antarctica/McMurdo">Antarctica/McMurdo</option>
                                 <option value="Antarctica/Palmer">Antarctica/Palmer</option>
                                 <option value="Antarctica/Rothera">Antarctica/Rothera</option>
                                 <option value="Antarctica/Syowa">Antarctica/Syowa</option>
                                 <option value="Antarctica/Troll">Antarctica/Troll</option>
                                 <option value="Antarctica/Vostok">Antarctica/Vostok</option>
                                 <option value="Arctic/Longyearbyen">Arctic/Longyearbyen</option>
                                 <option value="Asia/Aden">Asia/Aden</option>
                                 <option value="Asia/Almaty">Asia/Almaty</option>
                                 <option value="Asia/Amman">Asia/Amman</option>
                                 <option value="Asia/Anadyr">Asia/Anadyr</option>
                                 <option value="Asia/Aqtau">Asia/Aqtau</option>
                                 <option value="Asia/Aqtobe">Asia/Aqtobe</option>
                                 <option value="Asia/Ashgabat">Asia/Ashgabat</option>
                                 <option value="Asia/Atyrau">Asia/Atyrau</option>
                                 <option value="Asia/Baghdad">Asia/Baghdad</option>
                                 <option value="Asia/Bahrain">Asia/Bahrain</option>
                                 <option value="Asia/Baku">Asia/Baku</option>
                                 <option value="Asia/Bangkok">Asia/Bangkok</option>
                                 <option value="Asia/Barnaul">Asia/Barnaul</option>
                                 <option value="Asia/Beirut">Asia/Beirut</option>
                                 <option value="Asia/Bishkek">Asia/Bishkek</option>
                                 <option value="Asia/Brunei">Asia/Brunei</option>
                                 <option value="Asia/Chita">Asia/Chita</option>
                                 <option value="Asia/Choibalsan">Asia/Choibalsan</option>
                                 <option value="Asia/Colombo">Asia/Colombo</option>
                                 <option value="Asia/Damascus">Asia/Damascus</option>
                                 <option value="Asia/Dhaka">Asia/Dhaka</option>
                                 <option value="Asia/Dili">Asia/Dili</option>
                                 <option value="Asia/Dubai">Asia/Dubai</option>
                                 <option value="Asia/Dushanbe">Asia/Dushanbe</option>
                                 <option value="Asia/Famagusta">Asia/Famagusta</option>
                                 <option value="Asia/Gaza">Asia/Gaza</option>
                                 <option value="Asia/Hebron">Asia/Hebron</option>
                                 <option value="Asia/Ho_Chi_Minh">Asia/Ho_Chi_Minh</option>
                                 <option value="Asia/Hong_Kong">Asia/Hong_Kong</option>
                                 <option value="Asia/Hovd">Asia/Hovd</option>
                                 <option value="Asia/Irkutsk">Asia/Irkutsk</option>
                                 <option value="Asia/Jakarta">Asia/Jakarta</option>
                                 <option value="Asia/Jayapura">Asia/Jayapura</option>
                                 <option value="Asia/Jerusalem">Asia/Jerusalem</option>
                                 <option value="Asia/Kabul">Asia/Kabul</option>
                                 <option value="Asia/Kamchatka">Asia/Kamchatka</option>
                                 <option value="Asia/Karachi">Asia/Karachi</option>
                                 <option value="Asia/Kathmandu">Asia/Kathmandu</option>
                                 <option value="Asia/Khandyga">Asia/Khandyga</option>
                                 <option value="Asia/Kolkata">Asia/Kolkata</option>
                                 <option value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
                                 <option value="Asia/Kuala_Lumpur">Asia/Kuala_Lumpur</option>
                                 <option value="Asia/Kuching">Asia/Kuching</option>
                                 <option value="Asia/Kuwait">Asia/Kuwait</option>
                                 <option value="Asia/Macau">Asia/Macau</option>
                                 <option value="Asia/Magadan">Asia/Magadan</option>
                                 <option value="Asia/Makassar">Asia/Makassar</option>
                                 <option value="Asia/Manila">Asia/Manila</option>
                                 <option value="Asia/Muscat">Asia/Muscat</option>
                                 <option value="Asia/Nicosia">Asia/Nicosia</option>
                                 <option value="Asia/Novokuznetsk">Asia/Novokuznetsk</option>
                                 <option value="Asia/Novosibirsk">Asia/Novosibirsk</option>
                                 <option value="Asia/Omsk">Asia/Omsk</option>
                                 <option value="Asia/Oral">Asia/Oral</option>
                                 <option value="Asia/Phnom_Penh">Asia/Phnom_Penh</option>
                                 <option value="Asia/Pontianak">Asia/Pontianak</option>
                                 <option value="Asia/Pyongyang">Asia/Pyongyang</option>
                                 <option value="Asia/Qatar">Asia/Qatar</option>
                                 <option value="Asia/Qostanay">Asia/Qostanay</option>
                                 <option value="Asia/Qyzylorda">Asia/Qyzylorda</option>
                                 <option value="Asia/Riyadh">Asia/Riyadh</option>
                                 <option value="Asia/Sakhalin">Asia/Sakhalin</option>
                                 <option value="Asia/Samarkand">Asia/Samarkand</option>
                                 <option value="Asia/Seoul">Asia/Seoul</option>
                                 <option value="Asia/Shanghai">Asia/Shanghai</option>
                                 <option value="Asia/Singapore">Asia/Singapore</option>
                                 <option value="Asia/Srednekolymsk">Asia/Srednekolymsk</option>
                                 <option value="Asia/Taipei">Asia/Taipei</option>
                                 <option value="Asia/Tashkent">Asia/Tashkent</option>
                                 <option value="Asia/Tbilisi">Asia/Tbilisi</option>
                                 <option value="Asia/Tehran">Asia/Tehran</option>
                                 <option value="Asia/Thimphu">Asia/Thimphu</option>
                                 <option value="Asia/Tokyo">Asia/Tokyo</option>
                                 <option value="Asia/Tomsk">Asia/Tomsk</option>
                                 <option value="Asia/Ulaanbaatar">Asia/Ulaanbaatar</option>
                                 <option value="Asia/Urumqi">Asia/Urumqi</option>
                                 <option value="Asia/Ust-Nera">Asia/Ust-Nera</option>
                                 <option value="Asia/Vientiane">Asia/Vientiane</option>
                                 <option value="Asia/Vladivostok">Asia/Vladivostok</option>
                                 <option value="Asia/Yakutsk">Asia/Yakutsk</option>
                                 <option value="Asia/Yangon">Asia/Yangon</option>
                                 <option value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
                                 <option value="Asia/Yerevan">Asia/Yerevan</option>
                                 <option value="Atlantic/Azores">Atlantic/Azores</option>
                                 <option value="Atlantic/Bermuda">Atlantic/Bermuda</option>
                                 <option value="Atlantic/Canary">Atlantic/Canary</option>
                                 <option value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
                                 <option value="Atlantic/Faroe">Atlantic/Faroe</option>
                                 <option value="Atlantic/Madeira">Atlantic/Madeira</option>
                                 <option value="Atlantic/Reykjavik">Atlantic/Reykjavik</option>
                                 <option value="Atlantic/South_Georgia">Atlantic/South_Georgia</option>
                                 <option value="Atlantic/St_Helena">Atlantic/St_Helena</option>
                                 <option value="Atlantic/Stanley">Atlantic/Stanley</option>
                                 <option value="Australia/Adelaide">Australia/Adelaide</option>
                                 <option value="Australia/Brisbane">Australia/Brisbane</option>
                                 <option value="Australia/Broken_Hill">Australia/Broken_Hill</option>
                                 <option value="Australia/Currie">Australia/Currie</option>
                                 <option value="Australia/Darwin">Australia/Darwin</option>
                                 <option value="Australia/Eucla">Australia/Eucla</option>
                                 <option value="Australia/Hobart">Australia/Hobart</option>
                                 <option value="Australia/Lindeman">Australia/Lindeman</option>
                                 <option value="Australia/Lord_Howe">Australia/Lord_Howe</option>
                                 <option value="Australia/Melbourne">Australia/Melbourne</option>
                                 <option value="Australia/Perth">Australia/Perth</option>
                                 <option value="Australia/Sydney">Australia/Sydney</option>
                                 <option value="Europe/Amsterdam">Europe/Amsterdam</option>
                                 <option value="Europe/Andorra">Europe/Andorra</option>
                                 <option value="Europe/Astrakhan">Europe/Astrakhan</option>
                                 <option value="Europe/Athens">Europe/Athens</option>
                                 <option value="Europe/Belgrade">Europe/Belgrade</option>
                                 <option value="Europe/Berlin">Europe/Berlin</option>
                                 <option value="Europe/Bratislava">Europe/Bratislava</option>
                                 <option value="Europe/Brussels">Europe/Brussels</option>
                                 <option value="Europe/Bucharest">Europe/Bucharest</option>
                                 <option value="Europe/Budapest">Europe/Budapest</option>
                                 <option value="Europe/Busingen">Europe/Busingen</option>
                                 <option value="Europe/Chisinau">Europe/Chisinau</option>
                                 <option value="Europe/Copenhagen">Europe/Copenhagen</option>
                                 <option value="Europe/Dublin">Europe/Dublin</option>
                                 <option value="Europe/Gibraltar">Europe/Gibraltar</option>
                              </select>
                           </div>
                        </div>
                         <span v-show="errors.has('timezone')" class="invalid-feedback">{{timezoneError}}</span>
                     </div>
                 </p>
                  <p class="bd-notification is-info">
                     <label>Number of Decimals for Tax Rounding: <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="tax_rounding" id="tax_rounding" v-model="system.tax_rounding" v-validate="'required'" >
                                 <option selected value="2">2</option>
                                 <option value="4">3</option>
                                 <option value="4">4</option>
                              </select>
                           </div>
                        </div>
                         <span v-show="errors.has('tax_rounding')" class="invalid-feedback">{{tax_roundingError}}</span> 
                     </div>
                </p>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Date Format <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="date" id="date" v-model="system.date" v-validate="'required'" >
                                  <option value="ca-ES">DD/MM/YYYY</option>
                                  <option value="fa-IR">MM/DD/YYYY</option>
                                  <option value="ja-JP">YYYY/MM/DD</option>
                                  <option value="da-DK">DD-MM-YYYY</option>
                                  <option value="sma-SE">YYYY-MM-DD</option>
                                  <!-- <option value="de-DE">DD.MM.YYYY</option>
                                  <option value="sah-RU">MM.DD.YYYY</option>
                                  <option value="ko-KR">YYYY.MM.DD.</option> -->
                                
                              </select>
                           </div>
                        </div>
                   <span v-show="errors.has('date')" class="invalid-feedback">{{dateError}}</span>     
                     </div>
                  </p>
                  <p class="bd-notification is-info">
                     <label>
                        version <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <input class="input" type="text" placeholder="2019-20" disabled>
                        </p>
                     </div>
                  </p>
                  <p class="bd-notification is-info">
                     <label>Base Currency <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <!-- <select id="currency" name="currency"  v-model="system.currency" v-validate="'required'" class="select-basecurrency">
                                 <!-- <option value="Australian Dollar">Australian Dollar</option>
                                 <option value="Euro">Euro</option> -->
                            <!-- <option v-for="currencies in currency" v-bind:value="currencies.name">
                            {{currencies.name}}
                         </option>     
                      </select> -->
                           <select id="base_currency" name="base_currency" v-model="system.base_currency" class="select-basecurrency">
                      <option v-for="currencies in basecurrency"  v-bind:value="currencies.id">
                            {{currencies.name}}
                         </option>   
                        
                      </select>
                           </div>
                        </div>
                        <span v-show="errors.has('base_currency')" class="invalid-feedback">{{basecurrencyError}}</span>    
                     </div>
                </p>
               </div>
               <div class="column">
                  <p class="bd-notification is-info">
                     <label>Use 24 Hour Time Format <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="timeformat" id="timeformat" v-model="system.timeformat" v-validate="'required'">
                                 <option  value="1">Yes</option>
                                 <option value="0">No</option>
                              </select>
                           </div>
                        </div>
                       <span v-show="errors.has('time')" class="invalid-feedback">{{timeformatError}}</span>      
                     </div>
                  </p>
                  <p class="bd-notification is-info">
                     <label>Number of Decimals for Quantities and Amounts <span class="has-text-danger">*</span></label>
                     <div class="field has-addons">
                        <div class="control is-expanded">
                           <div class="select is-fullwidth">
                              <select name="quantities" id="quantities" v-model="system.quantities" v-validate="'required'">
                                 <option selected value="0">0</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                              </select>
                           </div>
                        </div>
                      <span v-show="errors.has('quantities')" class="invalid-feedback">{{quantitiesError}}</span>       
                     </div>
                   </p>
                     <p class="bd-notification is-info">
                     <label>Financial Date <span class="has-text-danger">*</span>
                     </label>
                     <div class="field">
                        <p class="control has-icons-left has-icons-right">
                           <b-datepicker id="financial_date" name="financial_date"  v-model="system.financial_date" v-validate="'required'"
                             placeholder="enter date.." icon="calendar-today">
                           </b-datepicker>
                          <!-- <b-datepicker placeholder="06/12/2019" icon="calendar-today"></b-datepicker> -->
                      <span v-show="errors.has('financial_date')" class="invalid-feedback">{{financialError}}</span>
                        </p>

                     </div>
                  </p>

               </div>
            </div>
            <div class="breadcrumb is-pulled-right" aria-label="breadcrumbs">
               <button class="button has-background-dark has-text-white is-size-7" ><i class="far fa-save icon1"></i>SAVE</button>
            </div>
         </form>
      </section>
      <layout-footer></layout-footer>
   </section>
</template>
<script>
   import { mapState, mapActions, mapGetters } from "vuex";
   import LayoutHeader from "./layouts/Header.vue";
   import LayoutFooter from "./layouts/Footer.vue";
   import { Validator } from "vee-validate";
    import moment,{ defaultFormat } from 'moment';
   export default {
      components: {
         LayoutHeader,
         LayoutFooter
      },
      name: 'app',
      data() {
         return {
            basecurrency:[],
            system: {
               id: "",
               language: "",
               timezone: "",
               tax_rounding: "",
               date: "",
               base_currency: "",
               timeformat: "",
               quantities: "",
               financial_date: "",
            },
       
        submitted: false,
        editMode: false,

         validlanguage : "language is required",
         validtimezone : "timezone is required",
         validtax_rounding: "rounding is required",
         validdate: "date is required",
         validcurrency: "currency is required",
         validtimeformat: "time is required",
         validquantities: "decimals is required"

      }
   },

    computed:{
        ...mapState({
      loading: state => state.isLoading,
      userState: state => state.user
    }),
      languageError(){
        if(this.system.language == "")
          return this.validlanguage
      },
      timezoneError(){
         if(this.system.timezone == "")
          return this.validtimezone
      },
      tax_roundingError(){
         if(this.system.tax_rounding == "")
         return this.validtax_rounding
       },
      basecurrencyError(){
         if(this.system.basecurrency == "")
          return this.validcurrency
      },

      timeformatError(){
         if(this.system.timeformat == "")
          return this.validtimeformat
      },
      quantitiesError(){
        if(this.system.quantities == "")
          return this.validquantities 
      },
      financialError(){
         if(this.system.financial_date == "")
          return this.validfinancialdate
      },
      dateError(){
          if(this.system.date == "")
          return this.validdate 
      }
    },
   mounted() {
   //   if (this.$route.params.id != '' && this.$route.params.id != null)
      this.editgetSystem();
      this.getbasecurrency();
    },
      methods: {

         ...mapActions({
      setLoading: "setLoading"
    }),
         
         save() {
           this.submitted = true;
            this.setLoading(true);
              this.$validator.validate().then(valid => {
            if (valid) {
            let url = '/System';
            console.log(url);
            

            let config = {
               headers: {
                    Authorization: 'Bearer ' + sessionStorage.getItem('token')
               }
            }
            let formdata = new FormData();

            formdata.append('language', this.system.language);
            formdata.append('timezone', this.system.timezone);
            formdata.append('tax_rounding', this.system.tax_rounding);

            formdata.append('date', this.system.date);

            formdata.append('base_currency', this.system.base_currency);
            formdata.append('timeformat', this.system.timeformat);
            formdata.append('quantities', this.system.quantities);

            //  formdata.append('financial_date', this.system.financial_date);

             if (this.system.financial_date != '') {
                        var dateObj = new Date(this.system.financial_date);
                        var momentObj = moment(dateObj);
                        var momentString = momentObj.format('YYYY-MM-DD');
                        console.log("moment",momentString);
                        this.system.financial_date = momentString;
                        console.log("",this.system.financial_date);
                       formdata.append('financial_date', this.system.financial_date);
                     }


            axios.post(url, formdata, config).then(response => {

               if (response.data.status === 1) {
                  this.$buefy.toast.open({
                     duration: 5000,
                     message: response.data.message,
                     type: "is-success",
                     position: "is-top-right"
                    
                  });
               
               } else {
                  this.$buefy.toast.open({
                     duration: 5000,
                     message: response.data.message,
                     type: "is-danger",
                     position: "is-top-right"
                    
                  });
               }
            
            })
              .finally(() => {
                this.setLoading(false);
              });
            }
              });
         },
         
      //     editgetSystem() {
      //     let url = '/System';
      //     axios.get(url).then(response => {
      //     this.system = response.data.system_unitDetails;
      //    console.log("editsystem",response.data.system_unitDetails);
      //   });
      // },

      editgetSystem() {
         this.setLoading(true);
          let url = '/System';
          axios.get(url).then(response => {
          this.system = response.data.system_unitDetails;

          var dateMomentObj = this.system.financial_date;
           
          var DateObj = moment(dateMomentObj);
          this.system.financial_date = new Date(DateObj);
        console.log("editsystem", this.system.financial_date);
      
        })
        .finally(() => {
                this.setLoading(false);
              });
      },
    

       getbasecurrency() {
           this.setLoading(true);
            let url = '/Currencies';
            console.log("url",url);
            axios.get(url).then((response) => {
            this.basecurrency = response.data.currenciesDetails;
            console.log("basecurrency",response.data.currenciesDetails);
       
        })
        .finally(() => {
                this.setLoading(false);
              });
    },
      }
     
     
   };
</script>