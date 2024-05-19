<?php
// تأكد من وجود مكتبة cURL
if (!function_exists('curl_init')) {
    die('cURL library is not available');
}

// الدالة لإرسال الزيارات
function sendTraffic($url, $numVisits, $ipList, $refererList) {
    for ($i = 0; $i < $numVisits; $i++) {
        $ch = curl_init();

        // اختيار عنوان IP عشوائي من القائمة
        $randomIP = $ipList[array_rand($ipList)];
        // اختيار موقع مرجعي عشوائي من القائمة
        $randomReferer = $refererList[array_rand($refererList)];

        // إعداد خيارات cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');
        curl_setopt($ch, CURLOPT_REFERER, $randomReferer);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR: ' . $randomIP, 'CLIENT-IP: ' . $randomIP));

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        // وقت انتظار عشوائي بين الطلبات (للتجنب من الاكتشاف بسهولة)
        usleep(rand(50, 100));
    }
}

// القائمة لعناوين الـ IP المسموح بها
$ipList = array(
'203.0.113.1',
'213.136.80.1',
'45.64.64.1',
'185.2.67.1',
'62.182.100.1',
'202.57.39.1',
'81.24.28.1',
'200.29.56.1',
'181.177.240.1',
'105.235.130.1',
'176.74.176.1',
'139.162.23.1',
'91.234.35.1',
'195.206.105.1',
'190.93.240.1',
'154.66.197.1',
'92.62.136.1',
'160.119.252.1',
'186.2.161.1',
'103.21.59.1',
'46.182.106.1',
'102.165.37.1',
'196.189.52.1',
'194.38.20.1',
'83.97.20.1',
'41.191.108.1',
'64.250.196.1',
'124.6.181.1',
'37.221.160.1',
'41.78.128.1',
'128.140.224.1',
'217.218.104.1',
'81.95.36.1',
'93.185.192.1',
'103.248.172.1',
'109.110.12.1',
'212.83.160.1',
'177.92.160.1',
'110.93.216.1',
'45.33.32.156',
'103.27.0.33',
'78.156.109.50',
'196.189.56.157',
'103.247.176.101',
'203.174.84.21',
'110.74.222.159',
'202.75.51.80',
'105.112.83.214',
'41.160.39.1',
'124.6.180.35',
'125.160.219.185',
'185.140.100.249',
'177.19.188.2',
'202.5.151.196',
'94.154.11.58',
'37.57.233.110',
'201.249.0.18',
'186.235.31.89',
'119.46.56.169',
'212.220.120.242',
'41.138.91.177',
'202.5.148.6',
'203.159.80.13',
'190.186.30.14',
'110.93.32.225',
'202.56.204.19',
'118.107.176.5',
'177.10.186.189',
'85.93.218.3',
'91.200.80.36',
'41.204.168.246',
'95.179.136.123',
'46.45.41.151',
'202.62.84.200',
'202.169.224.132',
'41.74.68.173',
'202.124.204.211',
'118.97.61.99',
'202.75.58.9',
'49.12.75.58',
'50.112.122.41',
'51.38.123.26',
'52.15.222.77',
'53.234.16.55',
'54.172.200.5',
'55.88.23.112',
'56.102.145.34',
'57.39.176.90',
'58.63.202.41',
'59.45.132.98',
'60.89.176.72',
'61.90.123.37',
'62.14.200.158',
'63.28.177.44',
'64.31.98.63',
'65.48.211.27',
'66.89.145.90',
'67.104.99.110',
'68.45.23.88',
'69.23.200.99',
'70.31.58.67',
'71.69.178.123',
'72.112.56.22',
'73.75.23.144',
'74.90.123.66',
'75.34.211.77',
'76.89.45.110',
'77.123.12.41',
'78.56.89.12',
'79.99.231.33',
'80.45.122.99',
'81.134.89.11',
'82.67.32.45',
'83.90.123.67',
'84.23.54.78',
'85.66.211.89',
'86.89.44.123',
'87.90.11.99',
'88.45.222.67',
'89.78.89.34',
'90.23.56.99',
'91.89.123.34',
'92.76.234.88',
'93.44.89.112',
'94.23.200.67',
'95.67.123.78',
'96.45.89.11',
'97.90.234.67',
'98.56.89.45',
'99.23.67.89',
'100.78.23.112',
'101.45.78.34',
'102.90.123.56',
'103.23.67.112',
'104.78.89.123',
'105.45.234.67',
'106.89.23.112',
'107.56.78.90',
'108.23.45.123',
'109.67.234.56',
'110.89.123.45',
'111.45.78.112',
'112.23.45.67',
'113.78.89.234',
'114.56.23.89',
'115.23.78.123',
'116.89.45.112',
'117.45.123.67',
'118.23.67.112',
'119.78.45.123',
'120.45.23.67',
'121.89.123.45',
'122.45.78.112',
'123.23.45.67',
'124.78.89.123',
'125.56.23.112',
'126.45.78.123',
'127.23.67.112',
'128.89.45.123',
'129.56.78.112',
'130.45.23.67',
'131.78.123.89',
'132.45.78.112',
'133.23.67.89',
'134.89.45.123',
'135.56.23.78',
'136.45.78.112',
'137.23.67.45',
'138.78.123.112',
'139.45.67.123',
'140.56.23.78',
'141.23.45.112',
'142.78.123.45',
'143.45.67.89',
'144.23.45.78',
'145.78.123.67',
'146.45.78.23',
'147.23.45.112',
'148.89.123.45',
'85.114.130.1'
);

// القائمة للمواقع المرجعية المسموح بها
$refererList = array(
    'http://mo4tc.com',
    'http://ar3ab.com',
    'https://facebook.com',
'https://www.beinyu.com',
'https://google.com',
'https://youtube.com',
'https://tmall.com',
'https://baidu.com',
'https://qq.com',
'https://sohu.com',
'https://taobao.com',
'https://360.cn',
'https://jd.com',
'https://amazon.com',
'https://yahoo.com',
'https://wikipedia.org',
'https://zoom.us',
'https://weibo.com',
'https://sina.com.cn',
'https://live.com',
'https://reddit.com',
'https://xinhuanet.com',
'https://netflix.com',
'https://microsoft.com',
'https://okezone.com',
'https://office.com',
'https://vk.com',
'https://instagram.com',
'https://csdn.net',
'https://alipay.com',
'https://microsoftonline.com',
'https://myshopify.com',
'https://yahoo.co.jp',
'https://zhanqi.tv',
'https://panda.tv',
'https://google.com.hk',
'https://bongacams.com',
'https://twitch.tv',
'https://amazon.in',
'https://naver.com',
'https://bing.com',
'https://apple.com',
'https://ebay.com',
'https://aliexpress.com',
'https://tianya.cn',
'https://stackoverflow.com',
'https://amazon.co.jp',
'https://adobe.com',
'https://google.co.in',
'https://livejasmin.com',
'https://twitter.com',
'https://yandex.ru',
'https://tribunnews.com',
'https://wikipedia.org',
'https://whatsapp.com',
'https://xvideos.com',
'https://pornhub.com',
'https://xnxx.com',
'https://tiktok.com',
'https://docomo.ne.jp',
'https://linkedin.com',
'https://openai.com',
'https://dzen.ru',
'https://xhamster.com',
'https://weather.com',
'https://samsung.com',
'https://vk.com',
'https://turbopages.org',
'https://naver.com',
'https://discord.com',
'https://pinterest.com',
'https://duckduckgo.com',
'https://facebook.com',
    'http://ar3ar.com'
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    $numVisits = filter_input(INPUT_POST, 'num_visits', FILTER_VALIDATE_INT);

    if ($url && $numVisits) {
        sendTraffic($url, $numVisits, $ipList, $refererList);
        echo 'Traffic sent successfully!';
    } else {
        echo 'Invalid input.';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إرسال الزيارات</title>
</head>
<body>
    <form method="post" action="">
        <label for="url">رابط الموقع:</label>
        <input type="url" id="url" name="url" required>
        <br>
        <label for="num_visits">عدد الزيارات:</label>
        <input type="number" id="num_visits" name="num_visits" required>
        <br>
        <button type="submit">إرسال الزيارات</button>
    </form>
</body>
</html>
