<?php

$para = array();

$para['integrator::welcome'] = <<<_P
SiteBar bütünleyici sayfasına hoşgeldiniz. Bu sayfa birçok SiteBar özelliğini kullanmanızı saglar. Daha çok SiteBar özelliğini <a href="http://sitebar.org/">SiteBar anasayfasında</a> bulabilirsiniz.
_P;

$para['integrator::header'] = <<<_P
SiteBar standartlara uygun tasarlanmıştır. SiteBar JavaScript ve çerezleri destekleyen
birçok tarayıcı ile çalışır. Aşağidaki tablo SiteBar'ın hangi tarayıcılarla test edildiğini göstermektedir.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar'da bağlantı ve klasörlerle ilgili menülerin açılması için farenin sağ tuşuna tıklanması gerekir.
Opera kullanıcıları "User Settings" kısmında bulunan "Menu Icon"u etkinleştirmelidirler ve klasör veya baglantının yanındaki simgeye tıklamalıdırlar. Opera <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>'yi desteklememektedir. XSLT ile ilgili özellikleri -"Kullanici Ayarlari" kısmından- kaldırmanız önerilir.
_P;

$para['integrator::hint'] = <<<_P
SiteBar'ı bir tarayıcıya(browser) bütünlemek için gereken bilgileri, yukarıdaki tarayıcı adlarına tıklayarak öğrenebilirsiniz. Lütfen diğer onaylanmış tarayıcıları/işletim sistemlerini <a href="http://brablc.com/mailto?o">bildiriniz</a>.
_P;

$para['integrator::hint_window'] = <<<_P
Bu bağlantı SiteBar'ın şuanki pencerede açılmasını sağlar. SiteBar geniş bir alanda çalışmak yerine dikey olarak çalışacak şekilde tasarlanmıştır. Bu yolla açılan SiteBar birçok alan harcayacaktır.
_P;

$para['integrator::hint_dir'] = <<<_P
Sitebar ağaç şeklinde görünmesinin yanı sıra normal klasör şeklinde de görüntülenebilir. Bu görünümde sadece bir klasör görüntülenir  
ve gösterilen bağlantıların da ayrıntıları görüntülenir. Tarayıcının <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>'yi desteklemesi gerekir.

_P;

$para['integrator::hint_popup'] = <<<_P
Eğer tarayıcınızın sidebar özelliği yoksa, bu bookmarklet*'i kullanabilirsiniz. Bu bookmarklet* sidebar'a benzeyen bir pop-up penceresinde SiteBar'ı açar. Fakat tarayıcınızın pop-up pencerelerini engelleyebileceğini unutmayınız!

_P;

$para['integrator::hint_addpage'] = <<<_P
Bu bookmarklet* SiteBar'a bağlantı eklemek için kullanılabilir. Çalıştırıldığında gezilen sayfanın ayrıntılarını kaydedecek şekilde bir pop-up penceresi açılır.

_P;

$para['integrator::hint_bookmarklet'] = <<<_P
*<a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> içinde JavaScript kodu bulunduran bir bağlantıdır. Buna sağ tuşla tıklayarak bağlantılar(bookmarks/favorites) klasörüne ekleyebilirsiniz. Daha sonra bu bağlantıya tıklanarak içindeki JavaScript kodu çalıştırabilir. </i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
SiteBar Bağlantı Arama özelliğini Ağ’da Arama kısmına ekler. Böylece SiteBar'daki bağlantılar SiteBar'ı açmadan aranabilir. 
_P;

$para['integrator::hint_sitebar'] = <<<_P
Eklenti özellikle SiteBar için oluşturulmuştur. Bu eklenti bir klasördeki tüm bağlantıları sekmelerde açmayı sağlar ve başka özellikler sunar. SiteBar simgelerini Araç çubuğuna eklemek için Görünüm/Araç Çubuğu/Kişiselleştir(View/Toolbars/Customize) menüsünü kullanınız. [<a href="http://sitebarsidebar.mozdev.org/">Proje sayfası</a>] 
_P;

$para['integrator::hint_sidebar'] = <<<_P
SiteBar'ı daha sonra sidebar panelinde açmak için bir bağlantı oluşturur.
_P;

$para['integrator::hint_booksync'] = <<<_P
Bookmark Synchronizer(Bağlantı Eşitleyicisi) eklentisini indirin. Firefox'u yeniden başlatın, Eklenti yöneticisini(Extension manager) açın  ve seçenekler(options) kısmından <strong>HTTP</strong>'yi seçin, host kısmına <strong>%s</strong> , path kısmına <strong>%s</strong> girin. Not: Şu anda sadece SiteBar'dan Firefox'a bağlantılar aktarılabilmektedir. 
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Tüm SiteBar'ın klasör yapısını bir dosyaya indirin. Bu dosyayı bağlantılar klasörüne alin (import). Her klasör Canlı Bağlantı şeklinde bulunacaktır. Böylece bağlantılar diğer bağlantılarınızla bütünlenmiş olacaktır, fakat klasör içeriği SiteBar'dan çevrimiçi olarak indirilecektir. Bir klasörün alt klasörleri olması durumunda, gerçek klasör @Content klasöründe görüntülenecektir.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
<a href="http://sourceforge.net/projects/mozlinker/">Eklenti</a>'yi indirin ve kurun (dikkat: eklentiyi kaldırmak mümkün değildir). Tarayıcıda "Mozlinker" adında yeni bir menü görünür. "Config..." altmenüsünü kullanarak ya yeni bir menü ya da yeni bir araç çubuğu (toolbar) ekleyin. Kaynak URL olarak sol taraftaki "MozLinker Extension" bağlantısının URL'sini kullanın.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
SiteBar'ı sidebar paneline ekler. Bu panel F9'a basılarak gösterilip, saklanabilir. Faviconlarin tarayıcıda önbelleklenmesi için SiteBarın ana sayfada açılması önerilir. Veya favicon gösterme özelliği kaldırılmalıdır(Kullanıcı ayarlarında).
_P;

$para['integrator::hint_hotlist'] = <<<_P
Hotlist panelinde SiteBar bağlantısı görünecektir. SiteBar'ı Opera sidebar'ında açmak için bu bağlantıya tıklayınız.
_P;

$para['integrator::hint_install'] = <<<_P
SiteBar'i Explorer çubuğuna ve sağ tuş menüsüne ekler - tüm özelliklerin kullanımı için Windows kayıt defterinde değişiklik ve yeniden başlatma gerekir. Bilgisayardaki kullanıcı haklarına bağlı olarak bazı özellikler yüklenemeyebilir.
<br>
Görünüm/Explorer Çubuğu (View/Explorer Bar) menüsünden SiteBar Explorer Çubuğunu açınız veya araç çubuğundaki sağ tuşla tıklayarak -Kişiselleştir...(Customize...) menüsünden Sitebar Panel tuşunu araç çubuğuna ekleyiniz. Sayfanın herhangi bir yerine sağ tuşla tıklayaraksayfayı SiteBar'a ekleyebilirsiniz. Ayni şekilde sayfadaki herhangi bir bağlantıya sağ tuşla tıklayarak bağlantıyı SiteBar'a ekleyebilirsiniz.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Explorer Çubuğunu kaldırır (yukarıya bakiniz).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Kullanıcının explorer çubuğunu kurmak için bilgisayarda gerekli yetkilere sahip değilse bu bookmarkleti* kullanması tavsiye edilir. SiteBar'i geçici olarak tarayıcının Arama Explorer Çubuğuna yükler.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Eklentiyi indirir (hazırdaki URL ile). Sikiştirilmiş dosya "C:\Program Files\Maxthon\Plugin" klasörüne açılmalıdır. Yeniden başlatıldıktan sonra yeni bir Explorer Çubuğu eklenecektir.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Eklentiyi indirir (hazırdaki URL ile). Sikiştirilmiş dosya "C:\Program Files\Maxthon\Plugin" klasörüne açılmalıdır. Yeniden başlatıldıktan sonra Eklenti araç çubuğunda(Plugin toolbar) yeni bir simge eklenecektir. Bu simge açık olan sekmenin(tab) SiteBar'a eklenmesini sağlar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
SiteBar paketini kurmak için <strong>emerge sitebar</strong> komutunu çalıştırın.
_P;

$para['integrator::hint_debian'] = <<<_P
SiteBar paketini kurmak için <strong>apt-get install sitebar</strong> komutunu çalıştırın.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu "anında" DHTML menüleri hazırlayan hiyerarşik bir menüsistemidir ve verilerin işlenmesi için PHP script motorunu kullanır. SiteBar bağlantıları gerekli yapıda sağlar. Eğer fopen ile uzaktan dosyaların açılmasına izin verilirse şu kod gerekli yapıyı yükleyecektir:
<tt> LayersMenu::setMenuStructureFile('%s')
</tt>

_P;

$para['integrator::copyright3'] = <<<_P
TelifHakkı ; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> ve <a href='http://sitebar.org/team.php'>SiteBar Takımı</a>. Destek <a href='http://sitebar.org/forum.php'>forumu</a> ve <a href='http://sitebar.org/bugs.php'>hata</a> izleme.
_P;

$para['command::welcome'] = <<<_P
%s, SiteBar'a hoş geldiniz!
%s
<p> 
SiteBar klasör ve dosyalara sağ tuşla tıklandığında çıkan menüler ile çalışmaktadır. Eğer sizin kullandığınız işletim sistemi/tarayıcı sağ tuşu desteklemiyorsa, Ctrl ile birlikte tıklamayı deneyebilirsiniz. Veya "Kullanıcı Ayarları" bölümünden "Menü Simgesini Göster" seçeneğini seçili yaptıktan sonra simgelere tıklayıp kullanabilirsiniz.
<p> 
SiteBar hakkında daha çok bilgi öğrenmek için lütfen alt menüdeki "Yardim" bağlantısına tıklayınız.
<p> 
Şu anda giriş yapmış durumdasınız.

_P;

$para['command::signup_verify'] = <<<_P
<p>
Bu SiteBar kurulumunda SiteBar özelliklerini kullanabilmeniz için e-mail adresinizin gerçek olup, doğrulanması gerektirmektedir.
<p>
Eğer e-mail adresinizi doğru girdiyseniz size hemen bir e-mail gönderilecektir. Lütfen e-mail'deki bağlantıya tıklayınız.

_P;

$para['command::signup_approve'] = <<<_P
<p>
Bu SiteBar kurulumunda SiteBar'in özelliklerini kullanabilmeniz için bir yöneticinin sizin hesabinizi onaylaması gerekmektedir. 
<p>
Lütfen yöneticinin onaylamasını bekleyiniz - daha sonra e-mail ile bilgilendirileceksiniz

_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Bu SiteBar kurulumu e-mail adresinizin doğrulanmasını gerektirmektedir.Ayrıca SiteBar özelliklerini kullanabilmeniz için, önce yöneticinin hesabinizi onaylamasını gerektirmektedir.
<p>
Eğer e-mail adresinizi doğru girdiyseniz size hemen bir e-mail gönderilecektir. Lütfen e-mail'deki bağlantıya tıklayınız ve yöneticinin onaylamasını bekleyiniz - daha sonra e-mail ile bilgilendirileceksiniz.

_P;

$para['command::account_approved'] = <<<_P
Yönetici hesap açma isteğinizi kabul etti. %s email adresini kullanarak giriş yapabilirsiniz.
--

%s adresindeki SiteBar kurulumu.

_P;

$para['command::account_rejected'] = <<<_P
Yönetici hesap açma isteğinizi reddetti (email: %s)

--

%s adresindeki SiteBar kurulumu.

_P;

$para['command::account_deleted'] = <<<_P
Yönetici %s e-mail adresi ile kullandığınız hesap aktif olmadığı için, hesabınızı sildi. --  %s adresindeki SiteBar Kurulumu.
_P;

$para['command::reset_password'] = <<<_P
"%s" e-mailine ait SiteBar hesabinin parolasının sıfırlanması istenmiştir.

Eğer gerçekten parolayı sıfırlamak istiyorsanız şu bağlantıya tıklayınız:  %s 


-- 
%s adresindeki SiteBar.
_P;

$para['command::contact'] = <<<_P
Mesaj: %s --  %s adresindeki SiteBar kurulumu.
_P;

$para['command::contact_group'] = <<<_P
Grup: %s Mesaj: %s --  %s adresindeki SiteBar kurulumu.
_P;

$para['command::delete_account'] = <<<_P
Hesabınızı gerçekten silmek istiyor musunuz? Bu işlemin geriye dönüşü yoktur! Kalan tüm ağaçlar sistem yöneticisine verilecektir.
_P;

$para['command::email_link_href'] = <<<_P
<p>Kendi E-mail programınızla <a href="mailto:?subject=%s Web sitesi;body=İlgilenebileceğini düşündüğüm bir site buldum: %s  -- %s adresindeki SiteBar tarafından gönderilmiştir. Açık Kaynak Kodlu Bağlantı(Bookmark) Sunucusu http://sitebar.org">e-mail gönderin</a>

_P;

$para['command::email_link'] = <<<_P
İlgilenebileceğini düşündüğüm bir site buldum: "%s" %s %s -- %s adresindeki SiteBar tarafından gönderilmiştir. Açık Kaynak Kodlu Bağlantı(Bookmark) Sunucusu http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
SiteBar'in e-mail özelliklerini kullanmak ve düzgün ifade(regular expression)'ler ile gruplara üye olmayı sağlamak için e-mail doğrulamasını istediniz.Lütfen bu bağlantıya tıklayarak e-mail adresinizi doğrulayınız: 
%s

_P;

$para['command::verify_email_must'] = <<<_P
SiteBar kurulumundaki SiteBar hesabına üye oldunuz, Sitebar'ı kullanabilmeniz için e-mail adresinizin doğrulanması gerekmektedir. Lütfen e-mail adresinizi doğrulamak için aşağıdaki bağlantıya tıklayınız: %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer sık kullanılan bağlantıları "Netscape Bağlantılar Dosyası" formatında alıp - verebilir. Fakat, bu formatın Windows kodlaması ile yapılması gerekir, varsayılan UTF-8 kodlaması bu durumda çalışmaz.<br>

_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer'da Dosya/ Al - Ver(File/Import and Export) menüsünü kullanarak bağlantılarınızı Netscape Bookmark Dosyası şeklinde saklayıp SiteBar'a alabilirsiniz. Saklanan dosya Windows kodlamasında olacaktır – lütfen dosyayı (SiteBar'a) alırken codepage'i seçiniz, varsayılan UTF-8 çalışmayacaktır.
_P;

$para['command::noiconv'] = <<<_P
<br> Bu SiteBar sunucusunda Codepage çeviricisi yüklü değildir. <br>
_P;

$para['command::security_legend'] = <<<_P
Kurallar: <strong>O</strong>ku, <strong>E</strong>kle, <strong>D</strong>egiştir, <strong>S</strong>il, <strong>T</strong>amamen Sil, <strong>İ</strong>zin Ver
_P;

$para['command::purge_cache'] = <<<_P
Favicon'lari önbellekten silmek istediğinize emin misiniz?
_P;

$para['command::tooltip_baseurl'] = <<<_P
Bu kurulumu göstermeyen/takip etmeyen URL.
_P;

$para['command::tooltip_default_domain'] = <<<_P
Alan adı tanımlandığında, e-mail adresini üye adı olarak kullanan kullanıcıların belirtmesine gerek yoktur.
_P;

$para['command::tooltip_respect'] = <<<_P
E-mail'i sadece kullanıcı izin verirse gönder.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Sadece doğrulanan e-mail adreslerine e-mail gönder.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Yöneticiye anonim kullanıcılar tarafından ulaşılmasına izin ver.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Eğer izin verilmezse tüm kullanıcılar burda ayarlanmış olan arama motorunu kullanır ve bunu değiştiremezler.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Ziyaretçilerin üye olma formuna erişmesine ve SiteBar'a kaydolmalarına izin verir.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Bağlantı açıklamasını alıp verme için komutu gösterir.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Sitebar'ın kişisel kullanım için kurulumunu sağlar.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Kullanıcının ek ağaçlar oluşturmasına izin verir.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Kullanıcının sahip olduğu ağaçları silmesine izin verir.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Kullanıcılar kendi gruplarını oluşturabilirler. Aksi takdirde sadece yöneticiler bu hakka sahip olurlar.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Değişik kodlamalı sayfaları dönüştürmek için dönüştürme motorunu kullan (genellikle PHP eklentisidir) - bağlantıları alıp vermede önemlidir. Bazı durumlarda boş sayfa oluşumuna sebep olabilir.
_P;

$para['command::tooltip_use_compression'] = <<<_P
SiteBar tarafından gönderilen sayfalar bantgenişliğinden kazanmak için sıkıştırılır. Sıkıştırma eğer tarayıcı tarafı destekliyorsa kullanılabilir.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Eğer PHP kurulumu "mail" özelliklerini desteklerse kullanılır - e-mail özellikleri etkinleştirilebilir.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Bazı özellikler (favicon önbelleği) dışarıdaki adreslere erişim gerektirmektedir.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Kullanıcılar SiteBar'ı kullanmadan önce yönetici tarafından onaylanmalıdır.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Kullanıcılar SiteBar'ı kullanabilmek için önce e-mail adreslerini doğrulanmalıdırlar.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Logo'yu tepede göster - yavaş sunucular için etkin olmamalıdır, hızlı sunucularda reklam için kullanılabilir. 
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Ana SiteBar panelinde performans istatistiklerini ve sabit istatistikleri gösterir.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Bağlantıların anonim kullanıcılar tarafından doğrudan indirilip, yüklenmesini etkinleştirir. Eğer kullanıcı nasıl URL ekleyebileceğini biliyorsa etkin yapılmayabilir.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Kullanıcı arabirimi istekleri gönderdiğinde, favicon simgeleri sunucu tarafından veritabanına indirilecektir. Veri trafiğini artırır ve bağlanılan sunucu sayısını azaltarak favicon önbelleğini hızlandırır.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
İGİÇ(ilk giren ilk çıkar) yığını. En eski simge sistemden çıkartılır - önbelleğin boyutunu denetlemek için kullanılır.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Simgeler için izin verilen en fazla boyut (Bayt cinsinden). 
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Dışarıdaki sunucudan alıp yenilenmeden önce favicon önbellekte ne kadar kalacak.
_P;

$para['command::tooltip_verified'] = <<<_P
E-mail'i doğrulandı saymak için bunu işaretleyin.
_P;

$para['command::tooltip_demo'] = <<<_P
Bu hesabı (sınırlı özellikli ve şifresi değişemez) demo hesabı yapın. 
_P;

$para['command::tooltip_approved'] = <<<_P
Hesap onaylandı ve tüm özellikleriyle kullanılabilir.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
SiteBar ağacında klasörler bağlantılardan önce veya sonra gelsin.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Moderatörlere beni gruplarına eklemeleri için izin ver.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Üyesi olduğum grupların yöneticilerinin ve moderatörlerinin bana bilgi e-mail'i göndermelerine izin verir.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Bağlantı eklendiğinde ve favicon eksik olduğunda faviconu otomatik olarak al.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Güvenlik özelliği olan klasörleri süsle.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Komutları dışarıdaki pencerede çalıştır - her komut için yeniden yükleme yapmadan.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
XSLT destekli tarayıcı gerektiren özellikleri sakla.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Sadece açık klasörlerin içeriğini yükle.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
SiteBar, SSL(güvenli bağlantı) üzerinden kullanılıyorsa özel bağlantılar yüklenecektir.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Eğer mümkünse, çıktıya ana dal klasörü eklenmeyecektir.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Bazı tarayıcılar/işletim sistemleri sağ tuşla tıklamayı desteklemez. Böyle bir durumda bu sağ tuş menüsünü açmak için kullanılabilecek bir simge gösterir. 
_P;

$para['command::tooltip_auto_close'] = <<<_P
Başarılı olma durumunda komutların durumunu gösterme.
_P;

$para['command::tooltip_show_public'] = <<<_P
Başka kullanıcıların yayınladığı bağlantıları gösterir.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Favicon kullanımı SiteBar'ı daha güzel ve daha yavaş yapar. Bu kurulumda favicon önbelleği kullanıldığı zaman faviconların gösterimi hızlanır.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Başka kullanıcıların yayınladığı klasörleri saklamayı sağlar.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Tarayıcının sunduğu ipuçları yerine SiteBar ipuçlarını kullan. Böylece daha uzun ipuçlarına destek verilebilir ve birçok tarayıcı bunu destekler.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Silinmiş klasörleri ve bağlantıları işaretle (böylece bunlar daha sonra geri yüklenebilsin veya tamamen silinebilsin).
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Aramayı favori internet arama motorunuzun verdiği sonuçlarla genişletmeye veya o sonuçlara yönlendirmeye izin verir.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
İnternet arama motorunun sonuçları SiteBar'ın arama sonuçları ile aynı sayfada gösterilir.
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Kullanıcıların kendilerini gruba eklemelerine izin verir.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Grup Moderatörüne üye olmayanlar tarafından ulaşılmasına izin verir.
_P;

$para['command::tooltip_publish'] = <<<_P
Bu klasörü yayınla böylece bu klasörü herkes görebilsin.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Klasörün kendisini silmek yerine sadece içeriğini sil.
_P;

$para['command::tooltip_paste_content'] = <<<_P
İşlemi klasöre uygulamak yerine içeriğine uygula.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Bookmarklet'i tekrar kullandığında bu klasör varsayılan olarak ayarlansın.
_P;

$para['command::tooltip_private'] = <<<_P
Bu bağlantıyı "özel" olarak işaretle. Böylece klasör yayınlansa bile sadece ağacın sahibi bu bağlantıyı görebilir.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Bu bağlantıyı doğrulama - iç ağlarda doğrulama sorunu olan bağlantılar için kullanın.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Bu bağlantı doğrulamayı geçemedi. Ama  bunu hala tutmak isteyebilirsiniz.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Bu klasörü ve alt klasörlerini içiçe doğrula.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Yakın zamanda test edilmiş bağlantıları yeniden test etme - daha önceki doğrulamanın bitmediği zaman tekrarlanan doğrulamalar için kullanılır.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Sayfayı analiz etmeye ve eksik faviconları(kısayol simgeleri) bulmaya çalış.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Eğer favicon doğru değilse favicon URL'sini bağlantıdan sil - dikkatli kullanın.
_P;

$para['command::tooltip_rename'] = <<<_P
Bağlantıları içeriye alırken hepsinin yüklenebilmesi için aynı adlı bağlantıları yeniden adlandır.
_P;

$para['command::tooltip_hits'] = <<<_P
Kullanım istatistiği oluşturmak için tüm tıklamaları SiteBar sunucusu üzerinden yönlendir.
_P;

$para['command::tooltip_subdir'] = <<<_P
Tüm bağlantıları ve içiçe olan tüm klasörleri dışarıya verir.
_P;

$para['command::tooltip_flat'] = <<<_P
Bağlantıların tümü bir klasördeymiş gibi dışarıya ver.
_P;

$para['command::tooltip_cmd'] = <<<_P
SiteBar'a kolay giriş yapabilmek için en önemli SiteBar komutlarını ekle.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Bu SiteBar kurulumu e-mail doğrulaması gerektirmektedir. Lütfen e-mail adresinizi doğrulayınız, aksi takdirde hesabınız silinecektir.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
e-mail adresiniz aşagidaki gruplara otomatik üye olmaniz için gerekli kurallara uyuyor:  %s. Üyeliginizi onaylamak için, e-mail adresinizin dogrulanmasi gerekmektedir.Lütfen %s baglantisina tiklayarak e-mail adresini dogrulayiniz.
_P;

$para['usermanager::signup_info'] = <<<_P
Kullanici "%s" <%s>, %s'de SiteBar kurulumuna üye oldu.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
"%s" <%s> kullanicisi %s'deki SiteBar'a üye oldu. Kullanici e-mail adresini onayladi.
_P;

$para['usermanager::signup_approval'] = <<<_P
"%s" <%s> kullanicisi %s'deki SiteBar'a üye oldu.
Hesabi onayla: %s
Hesabi reddet: %s
Bekleyen kullanicilari göster: %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
"%s" <%s> kullanicisi %s'deki SiteBar'a üye oldu. Kullanici e-mail adresini onayladi.
Hesabi onayla: %s
Hesabi reddet: %s
Bekleyen kullanicilari göster: %s
_P;

$para['hook::statistics'] = <<<_P
{roots_total} Dal. {nodes_shown}/{nodes_total} Klasör. {links_shown}/{links_total} Baglanti. {users} Kullanici. {groups} Grup. {queries} SQL sorgusu . Veritabani/Toplam Zaman:{time_db}/{time_total} saniye ({time_pct}%).
_P;

?>
