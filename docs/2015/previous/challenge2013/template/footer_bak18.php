<?php
function get_footer($pageName) {
	if($pageName) {
		$pageName = "<li>$pageName</li>";
	} else {
		$pageName = "";
	}
	return <<<EOT
			</div><!--// #mainBK //-->
		</div><!--// #wrapperAll //-->

		<div id="footerPankuzu">
			<ul>
				<li><a href="index.html" title="ホーム">HOME</a></li>
				$pageName
			</ul>
		</div>
						
		<div id="footer">
			<a id="sponsor" name="sponsor"></a>
			<div id="footerBody"> 
			<div id="btmSponsorBK">
					<h3><img src="common/img/headplatinum_wb.jpg" alt="platinum sponsors" /></h3>
					<ul class="platinum">
						<li><a href="http://www.goo.ne.jp/" target="_blank"><img src="common/img/sponsores/goo_p.png" alt="NTTレゾナント" width="180" height="180"></a></li>
						<li><a href="http://www-06.ibm.com/innovation/jp/smarterplanet/cities/" target="_blank"><img src="common/img/sponsores/ibm180.png" alt="日本アイ・ビー・エム株式会社" width="180" height="180"></a></li>
						<li><a href="http://www.microsoft.com/japan" target="_blank"><img src="common/img/sponsores/microsoft180.png" alt="日本マイクロソフト株式会社" width="180" height="180"></a></li>
						<li><a href="http://jp.fujitsu.com/solutions/convergence/" target="_blank"><img src="common/img/sponsores/fujitsu_p.png" alt="富士通" width="180" height="180"></a></li>
						<li><a href="http://linkdata.org/" target="_blank"><img src="common/img/sponsores/linkdatalogo_180.png" alt="LinkData 独立行政法人　理化学研究所"></a></li>
						<!--<li><a href="http://www.goo.ne.jp/" target="_blank"><img src="common/img/sponsores/goo_p.png" alt="goo" width="180" height="180"></a></li> -->
						<!-- <li><a href="http://www.ibm.com/jp/ja/" target="_blank"><img src="common/img/sponsores2012/ibm180.png" alt="日本アイ・ビー・エム株式会社" width="180" height="180"></a></li> -->
						<!-- <li><a href="http://jp.fujitsu.com/" target="_blank"><img src="common/img/sponsores/fujitsu_p.png" alt="fujitsu" width="180" height="180"></a></li> -->
						<!-- <li><a href="http://citydata.jp/" target="_blank"><img src="common/img/sponsores2012/citydata.png" alt="LinkData独立行政法人　理化学研究所" width="180" height="180"></a></li> -->
					</ul>
					
					<h3><img src="common/img/headgold_wb.jpg" alt="gold sponsors"></h3>
					<ul class="gold">
						<li><a href="http://www.imjp.co.jp/" target="_blank"><img src="common/img/sponsores/imj140.png" alt="株式会社アイ・エム・ジェイ"></a></li>
						<li><a href="http://www.indigo.co.jp/" target="_blank"><img src="common/img/sponsores/indigo.jpg" alt="インディゴ株式会社"></a></li> 
						<li><a href="http://www.infocom.co.jp/das/infolib/index.html" target="_blank"><img src="common/img/sponsores/infocom.png" alt="インフォコム株式会社"></a></li>
						<li><a href="http://atr-c.jp/" target="_blank"><img src="common/img/sponsores/ATR-Creative.png" alt="株式会社ATR Creative"></a></li>
						<li><a href="http://www.jst.go.jp/" target="_blank"><img src="common/img/sponsores/jst.png" alt="独立行政法人　科学技術振興機構"></a></li>
						<li><a href="https://live.cybozu.co.jp/" target="_blank"><img src="common/img/sponsores/cybozu.png" alt="サイボウズ株式会社"></a></li>
						<li><a href="http://www.saltlux.com/jp/" target="_blank"><img src="common/img/sponsores/saltlux.png" alt="株式会社ソルトルックス"></a></li>
						<li><a href="http://www.drecom.co.jp/" target="_blank"><img src="common/img/sponsores/Drecom.png" alt="株式会社ドリコム"></a></li>
						<li><a href="http://www.qpits.jp" target="_blank"><img src="common/img/sponsores/QPITS.png" alt="九州IT＆ITS利活用推進協議会"></a></li>
						<li><a href="http://virtualtech.jp/" target="_blank"><img src="common/img/sponsores/VTJlogo.png" alt="日本仮想化技術株式会社"></a></li>
						<li><a href="http://www.jipdec.or.jp/" target="_blank"><img src="common/img/sponsores/JIPDEC.png" alt="一般財団法人　日本情報経済社会推進協会　（JIPDEC）"></a></li> 
						<li><a href="http://biosciencedbc.jp/" target="_blank"><img src="common/img/sponsores/nbdc.png" alt="バイオサイエンスデータベースセンター"></a></li>
						<li><a href="http://www.biomedcentral.com/" target="_blank"><img src="common/img/sponsores/BMC_logo_main_gloss.png" alt="BioMed Central（バイオメド・セントラル）"></a></li>
						<li><a href="http://www.hitachiconsulting.co.jp/" target="_blank"><img src="common/img/sponsores/hitachi_consulting.png" alt="日立コンサルティング"></a></li>
						<li><a href="http://www.mri.co.jp" target="_blank"><img src="common/img/sponsores/mri.png" alt="株式会社三菱総合研究所"></a></li>
						<li><a href="http://www.machi-j.net/" target="_blank"><img src="common/img/sponsores/rits.png" alt="ＮＰＯまちづくりジャパン事務局 リッツ総合研究所"></a></li> 
						<!-- <li><a href="http://www.zenrin.co.jp/" target="_blank"><img src="common/img/sponsores2012/zenrin.png" alt="株式会社ゼンリン"></a></li>-->	
					</ul>
					
					<h3 class="footerDataPartner">データ提供パートナー</h3>
					<ul class="gold">
						<li><a href="http://www.osmf.jp/" target="_blank"><img src="common/img/sponsores/osmf.png" alt="オープンストリートマップ・ファウンデーション・ジャパン" /></a></li>
						<li><a href="http://www.ndl.go.jp/" target="_blank"><img src="common/img/sponsores/NDLJ.png" alt="国立国会図書館" /></a></li>
						<li><a href="http://kaken.nii.ac.jp/" target="_blank"><img src="common/img/sponsores/kaken.png" alt="国立情報学研究所 KAKEN: 科学研究費助成事業データベース" /></a></li>
						<li><a href="http://ci.nii.ac.jp/" target="_blank"><img src="common/img/sponsores/Cinii.png" alt="国立情報学研究所 CiNii（NII論文情報ナビゲータ[サイニィ]）" /></a></li>
						<li><a href="http://www.city.sabae.fukui.jp/" target="_blank"><img src="common/img/sponsores/sabae.png" alt="鯖江市役所" /></a></li>
						<li><a href="http://i-scover.ieice.org/" target="_blank"><img src="common/img/sponsores/i_scover_logo.png" alt="一般社団法人　電子情報通信学会 I-Scoverプロジェクト" /></a></li>
						<li><a href="http://www.csis.u-tokyo.ac.jp" target="_blank"><img src="common/img/sponsores/CSISlogo.png" alt="東京大学 空間情報科学研究センター" /></a></li>
						<li><a href="http://statdb.nstac.go.jp/" target="_blank"><img src="common/img/sponsores/gauss.png" alt="独立行政法人統計センター" /></a></li>
						<li><a href="http://www.yaf.or.jp/" target="_blank"><img src="common/img/sponsores/yaf.png" alt="公益財団法人　横浜市芸術文化振興財団" /></a></li>
						<li><a href="http://lod.ac/" target="_blank"><img src="common/img/sponsores/lodac.png" alt="LODAC: Linked Open Data for Academia" /></a></li>


					
					<!-- 	<li><a href="http://aigid.jp" target="_blank"><img src="common/img/sponsores2012/agid.png" alt="社会基盤情報流通推進協議会" /></a></li>-->
					<!-- 	<li><a href="http://www.csis.u-tokyo.ac.jp" target="_blank"><img src="common/img/sponsores2012/Csis.png" alt="東京大学 空間情報科学研究センター" /></a></li>-->
					<!-- 	<li><a href="http://www.editoria.u-tokyo.ac.jp/dias/" target="_blank"><img src="common/img/sponsores2012/dias.png" alt="東京大学　地球観測データ統融合連携研究機構" /></a></li> -->

					</ul>
					
					<h3 class="footerDataPartner">基盤提供パートナー</h3>
					<ul class="gold">
						<li><a href="http://monaca.mobi/" target="_blank"><img src="common/img/sponsores/Logo_Monaca.png" alt="アシアル株式会社"></a></li>
						<li><a href="http://www.ntt.com/" target="_blank"><img src="common/img/sponsores/logo_positive.png" alt="NTTコミュニケーションズ株式会社"></a></li>
						<li><a href="http://appkitbox.com/" target="_blank"><img src="common/img/sponsores/ntt_resonant_appkitbox.png" alt="NTTレゾナント株式会社"></a></li>
						<li><a href="http://www.microsoft.com/japan" target="_blank"><img src="common/img/sponsores/microsoft180.png" alt="日本マイクロソフト株式会社"　width="140" height="140"></a></li>
						<li><a href="http://linkdata.org/" target="_blank"><img src="common/img/sponsores/linkdata140.png" alt="LinkData 独立行政法人　理化学研究所"></a></li>
					</ul>			
					
					<h3 class="footerDataPartner">メディアパートナー</h3>
					<ul class="gold">
						<li><a href="http://itpro.nikkeibp.co.jp/" target="_blank"><img src="common/img/sponsores/ITpro.png" alt="ITPro" width="140" height="140"></a></li>
						<li><a href="http://www.atmarkit.co.jp/" target="_blank"><img src="common/img/sponsores/atIT.png" alt="at mark IT" width="140" height="140"></a></li>
						<li><a href="http://www.nikkei.com/" target="_blank"><img src="common/img/sponsores/nikkei_web.png" alt="at mark IT" width="140" height="140"></a></li>
					</ul>
					
					<h3 class="footerDataPartner">サポーター（後援団体）</h3>
					<ul class="supporter">
						<li><a href="http://www.opendata.gr.jp/" target="_blank">オープンデータ流通推進コンソーシアム</a></li>
						<li><a href="http://okfn.jp/" target="_blank">Open Knowledge Foundation Japan</a></li>
						<li><a href="http://creative-city.jp/" target="_blank">クリエイティブ・シティ・コンソーシアム</a></li>
						<li><a href="http://www.meti.go.jp/" target="_blank">経済産業省</a></li>
						<li><a href="http://www.ipsj.or.jp/" target="_blank">一般社団法人　情報処理学会</a></li>
						<li><a href="http://sigdd.sakura.ne.jp/" target="_blank">一般社団法人　情報処理学会　デジタルドキュメント研究会</a></li>
						<li><a href="http://www.ai-gakkai.or.jp/jsai/" target="_blank">一般社団法人　人工知能学会</a></li>
						<li><a href="http://sigswo.org/" target="_blank">一般社団法人　人工知能学会　セマンティックウェブとオントロジー研究会</a></li>
						<li><a href="http://s-web.sfc.keio.ac.jp/" target="_blank">セマンティックWeb委員会</a></li>
						<li><a href="http://www.ipa.go.jp/" target="_blank">独立行政法人　情報処理推進機構</a></li>
						<li><a href="http://www.soumu.go.jp/" target="_blank">総務省</a></li>
						<li><a href="http://www.jeita.or.jp/" target="_blank">一般社団法人　電子情報技術産業協会</a></li>
						<li><a href="http://www.facebook.com/bigdataopendata4city" target="_blank">ビッグデータ・オープンデータ活用推進協議会</a></li>
						<li><a href="http://linkedopendata.jp/" target="_blank">特定非営利活動法人　リンクト・オープン・データ・イニシアティブ</a></li>
						<li><a href="http://linkeddata.jp/" target="_blank">LinkedData勉強会</a></li>
						<!--<li><a href="http://okfn.jp/" target="_blank">Open Knowledge Foundation 日本グループ</a></li>-->
						<!--<li><a href="http://www.g-contents.jp/" target="_blank">gコンテンツ流通推進協議会</a></li>-->
						<!--<li><a href="http://s-web.sfc.keio.ac.jp/" target="_blank">セマンティックWeb委員会</a></li>-->
						<!--<li><a href="http://linkedopendata.jp/" target="_blank">特定非営利活動法人　リンクト・オープン・データ・イニシアティブ</a></li>-->
						<!--<li><a href="http://linkeddata.jp/" target="_blank">LinkedData勉強会</a></li>-->
					</ul>
				</div>
				<div id="footerMenu">
					<ul>
						<li><a href="contact.html" title="お問い合わせ">お問い合わせ</a></li>
						<li><a href="committee.html" title="実行委員会">実行委員会</a></li>
						<li><a href="rules.html" title="会則">会則</a></li>
						<li><a href="http://www.facebook.com/LOD.challenge.Japan" title="facebookページ" target="_blank">facebookページ</a></li>
					</ul>
					<!-- <p id="facebook"><a href="http://www.facebook.com/LOD.challenge.Japan#" title="LOD Challenge 2012 facebookページ"><img src="common/img/facebook.png" alt="Facebook" width="32" height="32" /></a></p> -->
				</div>
				<div id="credit">
					<p>Copyright&copy;2013 Linked Open Data Challenge Japan 2013.</p>
				</div><!--// credit //-->
			</div>
		</div><!--// footer //-->
	</body>
</html>
EOT;
}
?>