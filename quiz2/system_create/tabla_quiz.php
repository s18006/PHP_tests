<?php
//it's only an example
function row_creator ($x) {
    $conn = mysqli_connect("localhost", "testuser", "0808", "newtables");
    mysqli_query($conn, "SET NAMES 'UTF8'");
    $conn->query($x);
}

$x = array(
    array('select', 'M', 'LANの説明として、もっとも適切なものを選びなさい', 'インターネット上で構築される仮想的なネットワーク', 'WANを世界規模につなげたネットワーク', '家庭内や学校内といった限られた範囲に構成された小規模のネットワーク', '個々のネットワークを結ぶ広域のネットワーク', hash('sha256', json_encode('家庭内や学校内といった限られた範囲に構成された小規模のネットワーク')), ''),
    array('select', 'M', 'IoTの利用例として、もっとも適当なものを選びなさい', 'インターネット上にコミュニティを形成して多くの人と交流する', '自宅にある家電を外出先から操作したり、離れた場所にいるペットを見守ったりする', '電子メールを利用し、他人とコミュニケーションする', '目的に応じコンピュータ上で処理を行う', hash('sha256', json_encode('自宅にある家電を外出先から操作したり、離れた場所にいるペットを見守ったりする')), ''),
    array('select', 'M', 'パソコンの記憶装置である「SSD」についての説明として、誤って いるものを選びなさい', 'HDDと比べ耐衝撃性に優れている', 'HDDと比べると読み出し速度は遅い', 'HDDと比べ駆動部分がないため動作音が静か', '同じ容量のHDDと比較して価格が高い', hash('sha256', json_encode('HDDと比べると読み出し速度は遅い')), ''),
    array('select', 'M', '画面モードがXGAの画素数を選びなさい', '1280 X 768', '640 X 480', '1024 X 768', '800 X 600', hash('sha256', json_encode('1024 X 768')), ''),
    array('select', 'M', '光学メディアに関する説明として、正しいものを1つ選びなさい', "「DVD-R」や「BD-R」などの書き込み型メディアでは、規格上データの追記ができない", "片面１層の「BD-R」1枚には、「CDーROM」約100枚分のデータを書き込める", "両面２層の「DVD-ROM」は、「BD-ROM」と同じ容量を持つ", "「BD-RE」ディスクは、データの書き換えが可能なメディアである", hash('sha256', json_encode('「BD-RE」ディスクは、データの書き換えが可能なメディアである')), ''),
    array('select', 'M', '約650MBのCD-Rに、同じサイズの写真データが260枚分記録できた。これと同じサイズの写真データは、片面1層のDVD-Rには、およそ何枚記録できるか。もっとも近いものを選択肢から選びなさい', '500枚', '2000枚', '2500枚', '3000枚', hash('sha256', json_encode('2000枚')), ''),
    array('select', 'M', '以下のうち、Androidのアプリケーションを提供している、Google 社の配信サービスはどれか', 'Playストア', 'Google+', 'dマーケット', 'App Store', hash('sha256', json_encode('Playストア')), ''),
    array('select', 'M', '無線LANを識別する名前の呼び方を選びなさい', 'ホスト名', 'ドメイン名', 'SSID', 'FCDN', hash('sha256', json_encode('SSID')), ''),
    array('select', 'M', 'IPV6 アドレスの情報量を選びなさい', '32ビット', '64ビット', '128ビット', '256ビット', hash('sha256', json_encode('128ビット')), ''),
    array('select', 'M', 'ドメイン名とIPアドレスを関連付けるサーバを選びなさい', 'NTPサーバ', 'DHCP サーバ', 'FTPサーバ', 'DNS サーバ', hash('sha256', json_encode('DNS サーバ')), ''),
    array('bet-number', 'K', 'IMAP4で使用せれるポート番号(***)', '', '', '', '', hash('sha256', json_encode(143)), '3'),
    array('bet-number', 'K', '個人情報保護マネジメントシステム一要求事項 (JIS Q *****)', '', '', '', '', hash('sha256', json_encode(15001)), '5'),
    array('bet-text', 'K', '不正侵入検知の機能を実装する仕組みを一般に何と呼ばれるか(***)', '', '', '', '', hash('sha256', json_encode(strtolower('IDS'))), '3'),
    array('bet-text', 'K', '一斉ににたくさんの端末から攻撃者の命令で攻撃対象にアクセスする攻撃を一般に何と呼ばれるか (****)', '', '', '', '', hash('sha256', json_encode(strtolower('DDOS'))), '4'),
    array('bet-number', 'K', 'POP3で使用せれるポート番号(***)', '', '', '', '', hash('sha256', json_encode(110)), '3'),
    array('bet-number', 'K', 'HTTPSで使用せれるポート番号(***)', '', '', '', '', hash('sha256', json_encode(443)), '3'),
    array('bet-number', 'K', 'HTTPで使用せれるポート番号(***)', '', '', '', '', hash('sha256', json_encode(80)), '2')
);

for ($i = 0; $i < count($x); $i++) {
    $oszlop1 = $x[$i][0];
    $oszlop2 = $x[$i][1];
    $oszlop3 = $x[$i][2];
    $oszlop4 = $x[$i][3];
    $oszlop5 = $x[$i][4];
    $oszlop6 = $x[$i][5];
    $oszlop7 = $x[$i][6];
    $oszlop8 = $x[$i][7];
    $oszlop9 = $x[$i][8];
    $query = "INSERT INTO quiz3 VALUES ('', '$oszlop1', '$oszlop2', '$oszlop3', '$oszlop4', '$oszlop5', '$oszlop6', '$oszlop7', '$oszlop8', '$oszlop9')";
    row_creator($query);
}

?>
