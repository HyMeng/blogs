/*
Navicat MySQL Data Transfer

Source Server         : link1
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : z_baixiu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-02 23:41:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'uncategorized', '未分类');
INSERT INTO `categories` VALUES ('2', 'funny', '奇趣事');
INSERT INTO `categories` VALUES ('3', 'living', '会生活');
INSERT INTO `categories` VALUES ('4', 'travel', '去旅行');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `content` varchar(1000) NOT NULL,
  `status` varchar(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '蛋蛋', 'w@zce.me', '2017-07-04 12:00:00', '楼主，一起爬楼爬山约否', 'approved', '1', null);
INSERT INTO `comments` VALUES ('2', '弯弯', 'ee@gmail.com', '2017-07-05 09:10:00', '把擦多发点', 'rejected', '1', null);
INSERT INTO `comments` VALUES ('3', '李白', 'www@gmail.com', '2017-07-06 14:10:00', '可以啊 最近下雨啊', 'held', '1', null);
INSERT INTO `comments` VALUES ('4', '小花', 'www@gmail.com', '2017-07-09 22:22:00', '牛 有空带上我吗', 'held', '1', '3');
INSERT INTO `comments` VALUES ('5', '毛毛虫', 'w@zce.me', '2017-07-09 18:22:00', 'How are you?', 'held', '1', '3');
INSERT INTO `comments` VALUES ('6', '啊啊啊', 'www@gmail.com', '2017-07-11 22:22:00', 'I am fine thank you and you?', 'held', '1', '5');
INSERT INTO `comments` VALUES ('7', '秋冬', 'hh@gmail.com', '2017-07-22 09:10:00', '楼主 求那个黑金怎么拍', 'approved', '1', null);

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', 'site_url', 'http://localhost');
INSERT INTO `options` VALUES ('2', 'site_logo', '/static/assets/img/logo.png');
INSERT INTO `options` VALUES ('3', 'site_name', '我的博客');
INSERT INTO `options` VALUES ('4', 'site_description', '城里人是不让人活了！');
INSERT INTO `options` VALUES ('5', 'site_keywords', 'aa, bb, cc, dd, ff');
INSERT INTO `options` VALUES ('6', 'site_footer', '<p> 2016 itcast@ themebetter </p>');
INSERT INTO `options` VALUES ('7', 'comment_status', '1');
INSERT INTO `options` VALUES ('8', 'comment_reviewed', '1');
INSERT INTO `options` VALUES ('9', 'nav_menus', '[{\"icon\":\"fa fa-glass\",\"text\":\"aaa\",\"title\":\"aaa\",\"link\":\"/category/funny\"},{\"icon\":\"fa fa-phone\",\"text\":\"aaa\",\"title\":\"111\",\"link\":\"/category/tech\"},{\"icon\":\"fa fa-fire\",\"text\":\"222\",\"title\":\"aaa\",\"link\":\"/category/living\"},{\"icon\":\"fa fa-gift\",\"text\":\"aaa\",\"title\":\"aaa\",\"link\":\"/category/travel\"}]');
INSERT INTO `options` VALUES ('10', 'home_slides', '[{\"image\":\"uploads/slide_1.jpg\",\"text\":\"aaa\",\"link\":\"https://zce.me\"},{\"image\":\"uploads/slide_2.jpg\",\"text\":\"bbb\",\"link\":\"https://zce.me\"}]');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `feature` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `content` text,
  `views` int(11) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL COMMENT '???drafted/published/trashed?',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', 'laghavc', '口做眼段三命', 'http://dummyimage.com/800x600/79a2f2&text=zce.me', '1970-01-03 06:19:03', '如张安但热织研转价北院局备价适声。飞而经什个外器存起气战只电最自月战。机确题必由从科得放格化太。情易线分活至和飞型回物对北。题交况口治十几传确压文争传体片适图。且相切发受我即做如引力二联置较界备强。办命影北规第志劳安接者因求志回。还却十用国型府水低交就两理一。断派达程五别统有话第新非件管。复千保确接科器石素集和内往毛机只体。', '177', '34', 'drafted', '1', '2');
INSERT INTO `posts` VALUES ('2', 'foxhobbc', '府算己国外', 'http://dummyimage.com/800x600/f2e879&text=zce.me', '1970-01-05 01:50:26', '名度物华列其个参收一法证时。的叫专存高它义条音象家打场。带金点最没日大面条容联技细。建世再对你很那史满与三进斗装越色支利。便时大林专委很日条关劳进社外。必面持专料金机据于真华满于。气个工改程其院提单斯后类感需时。什明最取布间亲造克条该学市回改段证。象下工日影单油任体教争光节族界。确调相史研然问王记记改任们统。', '61', '85', 'published', '1', '3');
INSERT INTO `posts` VALUES ('3', 'sydrbpofm', '高本种明很接', 'http://dummyimage.com/800x600/79a4f2&text=zce.me', '1970-01-19 11:20:55', '与保比具置半和局身积适气候北马。变白世此加入比关必局积他白。很节事几都我常经什该空而其共。什通是体酸集容主者海决四却。米应切较更办务空素她马须我体会。前拉给战行群离与后政元统。采角明口听往论相风起各级场可难山先况。但开化商型万光团条资需素节。价百最包此整式命省办把领反亲实原。把电还算同之书理层组统资接自现治观。全样色严他第条率真支社角之然斗。列图群与此期张验可任明任办养切级。争是实叫适科也利清为传增件水身从万。史定除队在年装日史至效划其看矿改。', '169', '129', 'published', '2', '3');
INSERT INTO `posts` VALUES ('4', 'kxwci', '低果置', 'http://dummyimage.com/800x600/96f279&text=zce.me', '1970-02-08 22:58:56', '消没少将识七况们众验员济么装切。场适利保它相七属级农包置被七间府形。值关制形结实期展小京放验族流市己。家局工相场号转马领常风关。记省常多难体流厂力起反打知常。方半如以四技约体白始万证严了细该米。流参革这族长战加华车包之说流气处三。她石被九习文化消角区又地油议满复造。成才毛住下见又习成最片而白量办满受。必过基具红数写团委认研过低决正。治日门物少约住思感须系件将会。', '97', '82', 'trashed', '1', '1');
INSERT INTO `posts` VALUES ('5', 'eklvvc', '率如复三值养热', 'http://dummyimage.com/800x600/9af279&text=zce.me', '1970-02-13 23:05:24', '己那强委提又口每这学主打计。价起育流同质已党员际形应共确等之。她名局员少音商技细温派将。矿山安去力增细则九回段八集规其着片。当流年该南领象展积西题格社同。活农响无向走红又料备间花行。强体手被九们重格间引车华度厂一。立话真较文铁动成命解养众林本达化会。', '161', '141', 'published', '1', '4');
INSERT INTO `posts` VALUES ('6', 'tchjmeeed', '比下来观间', 'http://dummyimage.com/800x600/79f296&text=zce.me', '1970-02-18 16:34:40', '验由习员织打员不流图江安习。理心该面下今统子很管加各再来增外。不消化三代入二之经式养劳族院办结今。国口离色书安研队那型走际次。所低音专老被基少增白律第为个做被。种成学极反安动想又反力东向。达带正主九难统干心但四资。它用决只规到必具常社对己放生真。电反铁按结也华因计器光号京老通今界。造南加题际即今第眼反声越民位干成元认。更众干电置身可六发物接你能况长安连。但命步个保力查中院平满务。', '198', '120', 'drafted', '2', '2');
INSERT INTO `posts` VALUES ('7', 'okpy', '好效行下区', 'http://dummyimage.com/800x600/f27983&text=zce.me', '1970-02-21 02:44:07', '工近且通往铁空进斗千道易七选其步克用。五史会关利导便青革再将说本其且处给。又点志采直难则周心通千极月东。采其业千术分果须红光五人关事现见石。年三般处花别确维适细说备白下同状。断导而增段只类以又流太铁。克厂质片为用六空明局经识日头去约。安个比七之系本要音但调办。', '113', '4', 'published', '1', '3');
INSERT INTO `posts` VALUES ('8', 'wgyj', '目点场可', 'http://dummyimage.com/800x600/7979f2&text=zce.me', '1970-03-23 20:33:51', '和此种点学结级角精除这各。用高阶资步强复细命因响接系总劳。物或县团般平山连属才音学办以易学非。决准没高认易上感织织今识了条。非以严省大光主革段半把例象相律我。来白单龙电常东油进器太北装受王件。斯据空型己则型使边它确年物单区族半战。日百去才金感技因观声和样格安却。而会件与清调同亲则会完法。', '95', '176', 'published', '3', '1');
INSERT INTO `posts` VALUES ('9', 'bhrpuqc', '县来四养', 'http://dummyimage.com/800x600/d3f279&text=zce.me', '1970-04-09 09:37:32', '元总长多更量则面比原强位。现运收量数做济上候月道步解决者制离。命认群备派切分八斯利众象火利声半较关。且比传会器江断酸气表查先毛厂。周军革维难际行存队清压业影合。小行场华手按进气每转入少消展小。将越领定住然形图一响花置备连。成为极世斯个指气市建音县线切真造使。层即北照没不法写出派期如花。交得队江数精海维开音争能内造。极即再院马程九门火整题先料中产。力龙战安体快值管治建极路小。', '23', '63', 'trashed', '3', '4');
INSERT INTO `posts` VALUES ('10', 'lxjgjsgdku', '体厂金非', 'http://dummyimage.com/800x600/79f2dc&text=zce.me', '1970-06-22 03:04:43', '进与去此会历合新原所积和名先的。物常规查完想见完系米党平每做心该往同。属变已路则该却解育统结月个必。象外比根局规格号意强包她名华任持决。那严社分名史情局火个酸给却织。于部层领便元可发圆产例步会处。才但众命级当现往等置都众支具认。公与林治土能海长军将调走石。小件利流易能及小断员但等下前光做。万定带党强音装林民原包主往把近。音己几必持那别还构格没与离厂月社。', '64', '97', 'published', '3', '2');
INSERT INTO `posts` VALUES ('11', 'hefidpnxj', '开什为度山次', 'http://dummyimage.com/800x600/a979f2&text=zce.me', '1970-07-06 12:19:02', '低群革下论选火日中信指标严改等。声条度走政前把常包精打消身。等领流划们来济边热战新中格确军等。叫文八必转成期世设规道除。话信计太美角目物用段快面铁十地。织层每族候速认走代结线打。的效议段细还手过件过感严口素压。八拉广斯品示主及每府东音按铁土器规。程进风革团群八如总给求集交。治件但别儿严好消选市指外证。今之动细现细路质周要现素儿。', '117', '129', 'trashed', '1', '4');
INSERT INTO `posts` VALUES ('12', 'fvzxhgi', '党就点可阶', 'http://dummyimage.com/800x600/79a3f2&text=zce.me', '1970-07-19 02:37:17', '王带定深斯化它地展值地近位前史。农率干行示便支两听共全色公红己党老外。许发基家或历共度去关响者程间基市毛。列习也机从则建今般容斗主然了。达又加效走人军极速即构查美消下属领青。史严干易整和离整多它象行任或。究其确解阶几拉且复委料何北一根众。使按料状中实影红员争看干问指同。米系也信此铁须常维又油律精周海气的。增现传对规美组转两以关积飞半制。', '153', '31', 'published', '3', '2');
INSERT INTO `posts` VALUES ('13', 'lxsfjrwvel', '期展养道', 'http://dummyimage.com/800x600/79f2da&text=zce.me', '1970-09-14 16:06:12', '八度速义果八儿速并导过求能亲。然机听每的拉较它千华该物较际口。起结员及适叫而自林单世如力没角群。主越联好可与叫他制解百之道走越天开。务整当次感关着何传就圆克但严查书也义。么习江府声手车如代增化参在。铁门革情红二何况而别规主体。强改见身海用型传大要特住断领解手。约保型格务白平石质比那百。提低然维低可做少且组表清。往复明节史便光参身金科气明目记持矿。段次保根组已应处共飞并前今声报以。口走属东体山界精并即传保管品响火。于真干内阶定采通东备运六。', '72', '68', 'trashed', '1', '3');
INSERT INTO `posts` VALUES ('14', 'dmkvm', '四论划际经斯', 'http://dummyimage.com/800x600/79f2ad&text=zce.me', '1970-09-15 01:21:55', '局机同只厂越山此一指除矿决场。满级老指度样红厂精局文问常活见定约。持第际与选干研容们展报日年。平间这十列清治例王层政位百。例情公象把类电美离几料布万口。积分四目至平史决江素结明上斗式京断。切每美部大县个入自并办太听名。那及老切今被走别件段了温义头号叫农。', '63', '165', 'published', '3', '4');
INSERT INTO `posts` VALUES ('15', 'qwlaexx', '业次美真如段', 'http://dummyimage.com/800x600/f2b879&text=zce.me', '1970-09-22 04:47:33', '导实众治东共率展温专美样利图系。维达越风元数金共则列长了小铁。亲很务解等族斗斯加务具感走步运。列列生万间别命全决则如中程段区作率此。教中力增来化府外题北线市说。农着把组断者从存接农维府她深江红风。年取你算结许期设调九划何状受。小成和受交应业统阶清非九品了。光间有门次系教铁争半过她。产至年同转制任容示装法住此平意。或识信论清专影素你目效我资素划。复圆阶就长安委平问五头与。么风员任话她音农参却只见热。', '102', '13', 'trashed', '2', '2');
INSERT INTO `posts` VALUES ('16', 'fqcluokm', '龙从压水', 'http://dummyimage.com/800x600/ad79f2&text=zce.me', '1970-10-15 14:05:33', '活克他律外只毛际十习或此快连知基中音。本称千单使老几示响算对关带长亲想。速加区却是从教六后然影所结任。号清六省图华东多花解求单。色设参观求难值取包由包中书有头南节。部公米用林增物图保只社空何。布月条加接体条整家千管器然里。看感市律角适结连南场民称使五造果。光知叫酸美全整热它构验内级建。', '118', '154', 'published', '1', '2');
INSERT INTO `posts` VALUES ('17', 'gbwontqq', '事面示北不实团', 'http://dummyimage.com/800x600/f279dc&text=zce.me', '1970-11-15 12:17:29', '动数务事极半国治价真到压政样。非知酸常样即南我面并选按。再他道具委林技分它心已教华之二之。说细着全大写张任影确干京理条并北。期却况机发置今书线构理千。本记己织不史达律手便和世边色查较。较写反劳因公具着法算治料王工。习电想里因油日确律大产管。心存按了七向劳指半对南更世只白消权。完社强图务市才直克气长节。革本眼儿得争度更需社克值子具该。状统之处和取今派接克称由成次。务则子周转特五大本京做县因认界计。', '144', '39', 'published', '2', '1');
INSERT INTO `posts` VALUES ('18', 'iilui', '流头产六实持', 'http://dummyimage.com/800x600/79f27b&text=zce.me', '1970-11-17 17:19:41', '着各很气以水当文则组即众民。立广那厂带办实话府共以声论。里可观代也量拉每利他传员一车报酸织。区现话主我派合特理去织口生入儿法动千。各音确外光战有至天几程需采。转须省开论外好许二子阶算。派才光小品在响需件法法县。阶争领打马图声命际目东金目路回状。音更内眼得府办将支火由装立消最。这圆眼阶国单权区小县议七本。务质往非花圆十不研便流去心。原写作研及它林有育历支美日。收张总候题名青场场等名美点出。', '176', '67', 'trashed', '2', '2');
INSERT INTO `posts` VALUES ('19', 'bfsni', '规发步', 'http://dummyimage.com/800x600/f27b79&text=zce.me', '1970-12-08 17:38:39', '感边广半识立查民眼民从必办日消者装。共厂眼始热细记织切候想下改。离单深别加证调教时京江整先十。的工严种回劳打是义明复与。新可好被气发军界走指可常。油为百影采么者清但南天至层工积却。之水般西看造些专候深本专情光白非约。算节写容队中观始细整知少。清感上产圆着将经本太快近化金。', '52', '17', 'published', '3', '3');
INSERT INTO `posts` VALUES ('20', 'rnlirqecbp', '快别看按', 'http://dummyimage.com/800x600/f279e7&text=zce.me', '1970-12-22 01:29:05', '住收想领性给江酸将度图对。离转应议题情质龙眼难新列没但质且。厂象价员设些严那者会低回并。有查原需口属支接着动都于物容生北。团事局日被广从转多严组进山叫记样并。便基行工么厂按使线细物队农况动。里教我感式例育相设无中动比特集。公那干文图加种然包变产议飞地变可动。王品写放么中常要经花规接每王必目认适。决形办报样族体很物被去民世。产变结定领要团正组上对理重事学当。地由阶新转真内基多志正书体。', '70', '54', 'published', '3', '1');
INSERT INTO `posts` VALUES ('21', 'gokkv', '达周商公话', 'http://dummyimage.com/800x600/e279f2&text=zce.me', '1971-01-11 02:39:45', '之分圆看律史见使同和门温。建高须应广经收半到象题它龙电合天。力置自管二但小展感那把养入。必位整低阶运京现道图量说会选。反斗子百法条例四争器清队会它土得越。准何样相可市持积家织好步便复一。观所反再方包也文样带总南支。说管当影期值音律务调单下利质层立求重。长间他学验主造适包斯出百风三政。表三光数为属却本达称铁四气产己组具。结感流事口用上然然文见类整。就量元党出高外半值厂情史系张群。和过部按八军下改采严由现组号加性积。么较内解想消越并期美加音对精工办史。', '110', '198', 'published', '3', '4');
INSERT INTO `posts` VALUES ('22', 'qqvndyni', '等价于', 'http://dummyimage.com/800x600/f279ec&text=zce.me', '1971-02-14 15:59:55', '亲月水展争现多已济布象此团边京调。即石第素世按根支装商把根关取反用八。西圆才消物易打目样入有眼布生种。由有不无标把接期元因马被得点候想有。写那效力科点国么主加先图求引土如。战铁三与际组也和放难命知。特样华质保示流青果产识打有按。建重头东际事说权低基区新系万斯而多来。平养各再业机中火特高道习达利做回和除。', '162', '47', 'published', '2', '2');
INSERT INTO `posts` VALUES ('23', 'iefpt', '那京里算取', 'http://dummyimage.com/800x600/79f27e&text=zce.me', '1971-03-29 08:50:46', '众越就带更色称教放转价收部。战热了设度联局近团并和思运十只消。直持人军她府国受却化任战头生表很问。土收次处广所克况济花对存多就。它整空及任林切去最接团出实建代。化口步处车情必术先七流级经被。新取实便江从理后满使铁美应。总入月样完了机文千元义问周照。规况前才切部没国东受来切需认元。', '184', '80', 'published', '1', '4');
INSERT INTO `posts` VALUES ('24', 'rslk', '团解求期几容', 'http://dummyimage.com/800x600/f29079&text=zce.me', '1971-03-30 18:58:06', '例品长各京验劳王回行但清去风光制其。变音信接期严及算题通装长队定法。想具极联此内正里共整交元什究容育情。物关议层界者己须应点着来此白原主观。此适我层深全调身所明六片海没厂目。管越工拉采时果必领建安大改至切属。果多存经作者及需需算设切示。力求儿程本行矿速化使始厂调查在那论。处精队劳号者识常层身北制此色文通。结极理出导性先金联基大更委局必。加立这开所太与边题得安书应当金年状。事设带入米火已车电车增教眼资。', '58', '48', 'published', '2', '2');
INSERT INTO `posts` VALUES ('25', 'wpxlwi', '种由据才之集', 'http://dummyimage.com/800x600/f2799d&text=zce.me', '1971-04-09 13:49:06', '前县示律路提间革队问些拉后养类公面。件公速风这都王千业维持此件识。类于复相山都团器万多越子争。解拉相类确几布放强还需少。据今做派提应并务动各事些何江全进回。命分常并十清所影划眼者提响的式命。表南连性要内省支点却入除于率。类系众加却切海很记路我飞实。平资元月意立养段各斗资边气。准造部维才改识共百八马边运原节第只。标定集别保交队委新包支自治规权她众。', '163', '131', 'drafted', '1', '2');
INSERT INTO `posts` VALUES ('26', 'ykraao', '定人量立阶原角', 'http://dummyimage.com/800x600/f29979&text=zce.me', '1971-05-19 16:24:17', '里约但山术常将听气别传记众酸何。外龙要林识节查温少称机象五市它。技议六间我和美连里生气八期。工被角集线想于日工点族力美少具技。北用指准党例料打无但满位话五。局支物队即用电没每设质会方样放干。九美精节照了又龙完书系算队眼任红组。出除上打许国价织定角再技结深确与义。收任一经应成业联包记约日养周片空手。头学表被容难矿从计并去期取世不。', '150', '62', 'published', '1', '2');
INSERT INTO `posts` VALUES ('27', 'dlggcwqgo', '象史前从准', 'http://dummyimage.com/800x600/d3f279&text=zce.me', '1971-06-03 08:03:39', '圆响间也难地京实存线育际那水布听务属。先水区方增情力手王型他由三。种民局通第传张证业最究见知已约加。毛细基选查温器热天取部始条。效党济是少质知真边厂以千技接。别果经和石写和易完子九生到制红马场今。况角车事高再第毛们门料群几实。机好放准白议清这影省山器就权变有命调。气七火各道龙五管必地传越段众验决你表。问划提马性机农应线事人图天存族近组。节自活压场圆列现增划果争器人市分。证火来正使确特设际下政需来国。', '159', '149', 'trashed', '3', '2');
INSERT INTO `posts` VALUES ('28', 'jmwhgb', '百小集东', 'http://dummyimage.com/800x600/79f2e7&text=zce.me', '1971-06-06 05:54:23', '济该活开白非儿较如收什型只强马马。斯电识严县切段却西养打最值。体究铁设金分划备县技院北历所保名行自。京空业越改下表角求意儿每广团办军己切。然值七件土品历革色务国八展离二达看。角想科人日金强素空物话价增。方报片间们难府养单导北改治红价。主又界活意但立据道流相者。来界起金更再入风那布它带了备政快面。现儿边系度指难段离后较照级论生这约。低支力集说给从外图候属质非入治。', '48', '80', 'published', '1', '2');
INSERT INTO `posts` VALUES ('29', 'sdubumiyg', '王还程', 'http://dummyimage.com/800x600/def279&text=zce.me', '1971-06-09 20:24:46', '现便研话观一拉他条要处务例究些电数变。好青规开处数个老定变确数没往分共更。世照位识文期济据得据水等安。光较始是传转这因近难才维义行行时将。问县转成们龙厂得以象已制交。力些技候但阶把现十品度能。眼看意别光文响界风再公回写京验义车。们更观题声使影布圆龙江器。意照周求里质如阶快比须完。委不叫完原知料严任对形况管学具此南克。特千器众位价子并年值系部制它。市意二须面则原从几三之物六劳。', '200', '90', 'drafted', '2', '3');
INSERT INTO `posts` VALUES ('30', 'gvxgq', '叫权带', 'http://dummyimage.com/800x600/f2798f&text=zce.me', '1971-06-11 07:06:46', '共传主根界取确东算更无动团口论。越结专设年当物取上高号全石派九县率。记风历给再面有市周极将二该府快复。局本元方属切起认到矿想适压什光根条。美日现应子五门象支还机毛战平么很类种。性没反农斗与为维油两历选心小。万边活总般布象无将资处结多复系率。亲加北较所受山断铁其社程选克求个身。取这革金面领全即革出证见程非属示。线会查装物问除北为说委什走。', '83', '26', 'published', '3', '2');
INSERT INTO `posts` VALUES ('31', 'guvtqlogjd', '被离始提', 'http://dummyimage.com/800x600/d1f279&text=zce.me', '1971-06-29 19:18:20', '号易天会正没连统都大真响行段与。青般角面单七西复今转快去等车设清。没消统了治知边世从增际将门每对。中准红县持最又住理信片京。领二小电公太定置产规设路命斯要那与志。周革上处况压热到持什前民难思。流队前需属步院度志精速这八先联。节争时马别联型清变温本音动红作造。任月便同厂具同明率领说切意走些。求些称才东度单路目议动二没且去场说。重温开选十把有年其界被面造消。办十想毛出器部持属边反者铁料难。', '94', '176', 'trashed', '2', '3');
INSERT INTO `posts` VALUES ('32', 'tanetliig', '来决克米科', 'http://dummyimage.com/800x600/f279eb&text=zce.me', '1971-07-15 18:41:12', '际市些连包万包众收实身大常。写也效圆铁利示非期世养十系定层机则。验此林领克这支红有确地儿运。理有需资受非得志矿织先回今切设许将。放照什候府会消开育易计头回带织局识。观为光整量族然展百三日部花构里多时。收准什任群作叫火院那千车群了前书思图。许期第专义那如按通电值和龙局观接。数对成想老例叫主须出从全决。计还类关思济全律般保天原却。', '67', '170', 'drafted', '2', '1');
INSERT INTO `posts` VALUES ('33', 'khpwbp', '县开体儿', 'http://dummyimage.com/800x600/f0f279&text=zce.me', '1971-08-03 15:38:56', '感性行又色情设表理特系消形属合型各。育质型光细地线必图济世信究只农走。东元验前九区正市低式列备向如。林金而教从定最志次场指路地。强军此向需命都九厂教量传半声。整增然候律件元活感效持子区名。果管示阶个没志住农指有多压。六两员能叫本青复他图质持米价回组。型广报感上已它论管温相示较同三收两。电位身候办区改任世基经变器。器确局准分厂八速音过际报张育风没。', '199', '26', 'trashed', '2', '2');
INSERT INTO `posts` VALUES ('34', 'sctfvrei', '状九具经步线都', 'http://dummyimage.com/800x600/7996f2&text=zce.me', '1971-08-11 11:54:46', '家清力基复便放存已厂及部。斯据方天二派江样应具平再况好传增如据。共研可其知增响江确周切就少以增快市发。和斯去头关志快反建把写易处。之率保由影消水布体会观入正。果较属青来所见平经有何育但家。色月传总据分拉亲克你听用些。先地东程准到业加些实反二周认且该确。青可好能他表存儿志置现条增置适边活清。西入存置美论导总从律难压。更先育立义温如变也转影权头再。布们府酸学义把少关后油门求结至。', '188', '54', 'published', '3', '2');
INSERT INTO `posts` VALUES ('35', 'xomgbsn', '造规且目一', 'http://dummyimage.com/800x600/79f2c8&text=zce.me', '1971-08-17 18:01:06', '受报商说层金热代头将老商点气如联。委进斯五现界例使门素斗难低。带器清确术九得本水石老六没放持。王称号信才思消列带记备权王都容叫。理过数毛文有容专天入业对象色没着但。单速型你外原得学严断从中传并先记样。知通山单划周人新压从表四转合交出。京质米军应边解科便志江书做以度如。', '3', '159', 'published', '3', '2');
INSERT INTO `posts` VALUES ('36', 'whap', '叫十查', 'http://dummyimage.com/800x600/f279e3&text=zce.me', '1971-08-28 03:30:04', '整及单长等府每处安关料身或。构公名领眼京南意十色何马。务政想所是构声深温型性并地义社部周。我土商里很边有究效利界压力。土物向计用很单指并则每近治通收相者。想光造党周红次又指流速起明名么己。六八系方但小当原手响接进。她统被事族向想指时我目样立及学规。算信联知直认很须长从百打电者。几经龙证增具或量党重满照难劳论务派。然五看研南表意去转决员着。', '182', '178', 'trashed', '2', '2');
INSERT INTO `posts` VALUES ('37', 'nxgfirqbnq', '定准五按非物', 'http://dummyimage.com/800x600/f2b879&text=zce.me', '1971-10-23 10:41:54', '想程将程日确广约得集花马。影完山始用且相空片量且者和。同县做第带照为年史与平把人除干。制议领单两却便她片构里必何群和为基。情周照非对长直速效青她工有声东。适却第后但强法由程门心直革或金或量就。知名局北口转新者九事土难向义资。精保那红少深结叫始东市质他原。行队直历见但边需参断置断。解些厂多什明天代性广应题新引教。状问角之约产重时价有容技高成千农。管流义准只向院由角县高为百。器任无备强物派传取及基交写连示。', '128', '30', 'published', '2', '3');
INSERT INTO `posts` VALUES ('38', 'wvek', '才达分回本主', 'http://dummyimage.com/800x600/f279c4&text=zce.me', '1971-11-02 02:41:47', '物光应到段化命适开名程快青般情标。属北社阶构至则和路王情部能部就相级。根油因业结题提展这思界议度特联同以也。加加铁情质名别样取事由候记精十式团。选品至她车率气变称天最世级。多此指无值它程当工各市基命型相。成示便长老她容义水精交明八据划他又。任直美还易间命大之团思查各革报被难。因亲教进半学道群几山品常定整院酸么。些影组运也明管矿则事片革党空与团花。花万治者什张从照精机主规。种新七须对去光区性交权真。维说而响音同要斗织理深定断。', '29', '128', 'drafted', '2', '3');
INSERT INTO `posts` VALUES ('39', 'rmbj', '料交资低', 'http://dummyimage.com/800x600/79f293&text=zce.me', '1971-11-13 16:00:24', '己可人真走象阶况常风电列算论记。国建主成领局压研路起争指员南。题么派低土之物四已理断示代证般中权。利厂更制后从并回育习头量有。除快程六时圆技图过压学市子上接水。命上品导查写较集细白中第非青。单人员元石认已并写转知和。生精常精海千从动众线采交界发设候。许之日公位水然来清过按而阶区几整。', '159', '61', 'trashed', '3', '4');
INSERT INTO `posts` VALUES ('40', 'olndxa', '民示带热', 'http://dummyimage.com/800x600/7985f2&text=zce.me', '1971-11-13 22:36:43', '想民发装大对就马得导又书等。写断况本程道百经细想格物知能际内思。府干所结技级期利取证报龙张团。斯半代公省全广装按片况共动金厂。军关最边大题员增易光斯么用种位且性。相声论每一有候新王相是回马龙局委放各。后层叫今海省无海厂即例在导会科体。切提金接候消干子义不原号程同光商生。报例两但支派品律内名而真知干活。西众利名儿后日书产认做张别半七。各称组强用单习系统团矿上离上义题。候列总节是号条支每很论之期龙外最第。', '137', '118', 'published', '2', '3');
INSERT INTO `posts` VALUES ('41', 'uyhqtt', '分设生安拉石', 'http://dummyimage.com/800x600/79f27a&text=zce.me', '1971-11-17 06:12:45', '维难导给本识做取入形看导。展增政但者为习始史片称问月那放响。质样节法想统器色使争只示中本先。展带他世反动府手流及数利月气加。产由低率外它研称根目十极格种。期公要海些导须众组头改社听许近。外查众声上外经合确院其有叫且。热我属流本确什准得决样向。过选率米又济难快给何取业更极。很列它图证参件京干速运实所工调原。公增入白向内没步见离马革革水律制住。军区技斯采往导马北外期再七被最。', '138', '154', 'published', '2', '2');
INSERT INTO `posts` VALUES ('42', 'ojmqiiyww', '层就龙选化外共', 'http://dummyimage.com/800x600/86f279&text=zce.me', '1971-12-19 17:21:57', '式习统市机去十位来即音金按便。习总精场于只国清也元当合价。装办写温列红高较离任容些看维。划步意发没把务劳层决可劳更复总常并油。管许支现重学义究候身些质局心天立速。备适问至身群需团被色京听又以切。又养和包半土重委第多流争。已阶阶来住能型算养开名包类那打。很这对件么调百指当因问先速。济基准五角条积权去层性问边。了北始办而区但情很向容并示响制。', '72', '192', 'drafted', '2', '2');
INSERT INTO `posts` VALUES ('43', 'eppf', '象四养素现始', 'http://dummyimage.com/800x600/f2b779&text=zce.me', '1971-12-31 07:13:07', '风来却在色地公个马干准院白育又矿装。接受华劳便因必史儿克便却住还我空院。该构里今断须活再物区形也事业并花。些应她眼属系节达头离出县空美。入与被专天织始放得来史光认最集备政。使历作层素合心角空支太观权式。解头治局具了基活安究飞规转的强级律效。极院儿压机方识分照带两强。目都状你米标周节满时热联连段系离。小农活使高战样于件设还金电法县。', '69', '49', 'published', '3', '3');
INSERT INTO `posts` VALUES ('44', 'czfmz', '府无元月听', 'http://dummyimage.com/800x600/f2d079&text=zce.me', '1972-01-30 05:16:09', '米情体每题同活龙它约也需北。除到理况论养向马该族委会活马林革。切采器特新好件具不列单角商对九易制根。花部进市大把眼即教式或办又。造县队容比红代手参特统情况目直济素。步或放或出路区高华克半米器年使县记。报场公最但林数就党铁王准感广维。话验重律素在思机用山对张离公事规。事活成人已段识所布生离引明观维。造外出量题当界发商据管世照层化。中身别代海听油活包联论口合记委。', '51', '144', 'published', '1', '2');
INSERT INTO `posts` VALUES ('45', 'cxk', '格见说京', 'http://dummyimage.com/800x600/79eaf2&text=zce.me', '1972-01-31 15:37:07', '适政领文清样府他头布委治。织收消断代现合信比府年他全红。细量何族到行图是体林处走白近速当可。需比改无向离酸气联美听万值往以约。中她那达省形料思以水断亲领深给干别。化着却目精选火面说开影这属说际时务。这交车并即类标利变将斯该就到老花新。才设电置活增边容整便示面华指命参。革争本济段四好快准京月八。容思点路月走问议验单术或开写约。', '108', '133', 'published', '2', '2');
INSERT INTO `posts` VALUES ('46', 'ovrt', '平拉业此九万', 'http://dummyimage.com/800x600/f279ad&text=zce.me', '1972-03-18 00:28:18', '但正明县器日政三但动真行在段电容单。五步识信口物照安教技保小被号族农。识示论料省即装命况选况许具。期日走需确对却接情以复西置克据示。存花平争中林民之段我只品干龙斯。委活车路同品程况对已内圆议布。门土该信风可影证着就影行交式装。她度难记马合本周支直得己位。造样候通转温命业别层去复亲位。', '75', '185', 'trashed', '3', '3');
INSERT INTO `posts` VALUES ('47', 'eowvtyfy', '华只发保山', 'http://dummyimage.com/800x600/79c1f2&text=zce.me', '1972-03-18 03:41:32', '持看斗造照天速眼因油要太运务机。养后引叫经克该义区成装看此。什织段住里斗容问该应你料结族意至。进起构三身百八之世持各济中而至正车。需细建便近他在名示单党单别记各达越确。装半月他六离这边温写质却强气省路。示没毛世六科近动存除次记专史族。接完已我论地量近区音也都的使花须声确。常每百拉学战低式生效低团。全切强可认对导始九九直今利思什史。向马市话需易市问治要原亲气气。', '67', '175', 'trashed', '2', '4');
INSERT INTO `posts` VALUES ('48', 'epy', '形自集量热定', 'http://dummyimage.com/800x600/79f286&text=zce.me', '1972-03-22 20:34:30', '生展论算装消金较厂了究毛半给军术现。示派建天利于资段活面备象记调题。极感比计区连直点从科张意果系海才及。外路拉县选包见属制着展任思列事在。五记斗主眼且平可具眼规进置完。积角织知品身连话那你称步起。但十果特状比及共快政这准机向质习。变光出空统切记外等效严米。', '19', '51', 'drafted', '2', '3');
INSERT INTO `posts` VALUES ('49', 'htkjhvh', '应社历作数林', 'http://dummyimage.com/800x600/f2c079&text=zce.me', '1972-04-18 12:53:44', '量变构积备型军路回克学计往的时相。别型任工切口制太组布能制复。价米十直给国等党火军证机光走内。所见质等小整高事分开难着全系满响经。许山过路期深出就从采装一热代转。如价话权线去化需增族深容党处称式色部。易出加示交记最时做我上合下手具。而王战机共金斗明金一开何。真广求并之厂面员才红心利机。', '108', '190', 'published', '2', '1');
INSERT INTO `posts` VALUES ('50', 'jilrgjtue', '林立上市石或', 'http://dummyimage.com/800x600/d0f279&text=zce.me', '1972-04-19 17:24:37', '战太们热建给约林老受便收之公。工难识报界量联府性关格影指志。员取响位文形转报群决单光易构快。例县后己心石值影从厂外公。省向始单导连合位与多万次却场越构。照叫日走九克毛深引离厂领头。斯及力军些例业话保交感电会历计命。教确万三即光开亲她队半十列实全门。就地我节打油基家而列置响支些完眼。道事市率展完没规国响用海式管共格。前火铁白劳手眼度求做次料器军万类。快群转车列列专用思张却四养。', '74', '147', 'trashed', '1', '2');
INSERT INTO `posts` VALUES ('51', 'dvj', '体观观并', 'http://dummyimage.com/800x600/8af279&text=zce.me', '1972-05-08 13:11:32', '没说己总资图求难状候示间权据主清。质并事基线江年他重目照又示积交。期安战按任反集东看体外京。率新但影是关达想件列青听解位里气。报非称间构始公市风连存世。眼专真们这新际它状使验变保开然北己。经下展具明价示重运话电只行务米。个外素效统手响件来存求起上生特外十区。是叫里阶口克持育王角些知入精养话据。开集图起那间照全做保无结。处存管生社走办细百石人重条历。', '30', '22', 'published', '2', '2');
INSERT INTO `posts` VALUES ('52', 'iytser', '党满性', 'http://dummyimage.com/800x600/cbf279&text=zce.me', '1972-05-09 13:09:42', '四组调低务地也米素路北史张因联或。响从成给状共府满制型转地斗他认。式也情史温给即现没现省离她高面一花习。还常下区长走有动红大严华属状。回无地热手代身时资六经无工斗生层着据。合带争们科革率圆眼商带眼派按理容。好准和是回给亲场人华头取满情专多金。些各志海种上记做斗导次才也工布天程难。少油素度识阶再林身理得千必红。', '126', '119', 'published', '2', '2');
INSERT INTO `posts` VALUES ('53', 'znpywkc', '市如容还反水个', 'http://dummyimage.com/800x600/79acf2&text=zce.me', '1972-05-16 23:24:33', '品转把四个机没和那需习特时族动再。将格计口规则看成构起花积。易美金重导群说号农容照很接西制。音上能法干三照便里算意转动动习。很做收清果速验极系油比今儿参才动。证飞年千反观共展我被理压观导术。基百与算青争后那为易感按又物几改看。历法儿内料华你选收也四民之美。已石年活战种果教式使社且来。值样制的天代半设满比气同安件不以军。业品江较公听类各接信属集完要特。报专立级少果才来只行年土用他当长但。度开同军其长利管来压许酸手。', '27', '190', 'published', '3', '2');
INSERT INTO `posts` VALUES ('54', 'cimvqw', '进山农流', 'http://dummyimage.com/800x600/79f2e2&text=zce.me', '1972-05-17 01:17:44', '事制标反价参证较当那教许书代在想厂。争任具列元表想义联片那团子结身。式商热角已化飞厂电识色第矿车自值来。变各期果风科七看管花实边长种该。个消装些看段用有认因角明很。和相太里两从速党南手人低难就外。指它使象无性日政决许变道影圆设族精。给示技效劳情省号等离场万形天采民。约名毛克民志化生收立三线。七法打族体律件保斯使内且县志体。布好决边作清于例无得张车眼都空。易内始严严量才如实发己人龙想安。治准资千气证指中由统术作务片细带律。', '74', '190', 'drafted', '2', '1');
INSERT INTO `posts` VALUES ('55', 'mugvo', '面律行业常', 'http://dummyimage.com/800x600/f27986&text=zce.me', '1972-05-29 01:16:39', '到报花验体拉观适深克么万边则战业之。关生利济位系华件近边明意多知记二。出选达式复状示技管事第第红们子下力斗。北高位处单层他正资世件然口规毛去。指近斯儿细但准转山值重经气大验。国运一东型观清比务市教连头实题年六。说严来名两又于时段且律林意长改强。集新劳入与也学好线斗六儿其。再图增儿厂型深精识程需水状她面车具又。儿多识收有音进社之一部工争其到产。应地技分热后走即发时达办说。却们示原律连组别都标社提感率细变花团。', '11', '94', 'published', '2', '2');
INSERT INTO `posts` VALUES ('56', 'cmtoi', '属联后队较', 'http://dummyimage.com/800x600/f279a9&text=zce.me', '1972-06-13 01:23:10', '始原铁团道阶教段两你出采与与光。层却百为色族程你料有放干门家写近认。点与接写商解开步圆却百期地毛更动。接群报合方写明报儿府感程时。家红社数山集边月导史识么完商市手王。在铁我算界影圆很据业率光结又性所。心九特出资目年消八级里然即。查一办新道意年社查军低性自。身为备具却代近地装制观气设。', '82', '124', 'published', '2', '2');
INSERT INTO `posts` VALUES ('57', 'cqbfmmwzt', '六织起时', 'http://dummyimage.com/800x600/79f2c0&text=zce.me', '1972-06-19 05:09:01', '本由即划的照需照金大具人地信温区斗。报难导上增根于年动热存火科合。华局东所处新再组法细空化对。位水思须总广技圆林口毛原许育。全从新基什区图进料油值色。领素系保都车保技大器新历作三制强。油对物直小红位些院理族论结性容设半。查却解报我难斗众度学少算亲。群用精心千然商组物比革和华委。真把火说示走空从小精将精电。江回员权过她连军天除大需型米又立关采。白究长原已起就志断新原当厂受叫。声只水式解领持示同酸小员使包什验。', '197', '145', 'drafted', '2', '2');
INSERT INTO `posts` VALUES ('58', 'yshyk', '七成音重边当', 'http://dummyimage.com/800x600/90f279&text=zce.me', '1972-06-28 16:56:17', '争直化究史所整传应情必角老。四争世平车指指着断声直点非即红门。除法商据知色但听运物构年说易口观算。至整当收件存到向地中格拉能无自。联体书者四众四积形容部然六离和。农太海该严非始织治条华业。法山想消话平生化满离出那治高但从阶。们料素之立展已那厂化影间天。支商制酸装加东式称前结王光。商样声三都后地铁团史究共分。律你动队学小子连关战斗加现将置。主管性生行但革适识听二几。', '175', '11', 'drafted', '2', '1');
INSERT INTO `posts` VALUES ('59', 'qtkgt', '总真代万定', 'http://dummyimage.com/800x600/797cf2&text=zce.me', '1972-07-04 07:36:23', '听头选史带总通于县委具条必想强。意市深高则十命识或拉通精中铁物。近局规管解联易气便专育复影决。并数由观出众今一维置西须都些真。作风前列又改理为代期器型知正。当建委严海己么车连身际光革南者。日心两美国近求且住影值改而照在切话。拉空改造历委引花说听其质影全着那干。进转认者照示必任中联说产飞。须率斗九里基己转果个应办计等。', '87', '162', 'published', '2', '3');
INSERT INTO `posts` VALUES ('60', 'sqkfsmxin', '根七算图法', 'http://dummyimage.com/800x600/79e4f2&text=zce.me', '1972-07-07 18:26:56', '全群其最象定市红油来世认年海你包较。华离合强教平律根取究研一论术。约文时管得马教市把民单当化。特地之其现们这性须说性行走劳。果联领几志能眼究立太至向二属张风。当门许增什各究五术标定代集反便。权往最党温便布无断见然研精。式县只土结题处可天例传治则还府正率。气花样少战象更增而列说周。般外专局圆书论京目经选战专文美。八提易节提离常处快家展感统。', '192', '43', 'trashed', '1', '2');
INSERT INTO `posts` VALUES ('61', 'lepn', '律场基解', 'http://dummyimage.com/800x600/79cff2&text=zce.me', '1972-07-12 19:39:24', '运质京口何号教路业严始在区。社却立压其王想十东以去子。身京层价者原加等基如组毛记样线认。且但导眼商将究构即温形王和马。际此史斯道族计作张每厂办况圆前。领得认力党回老日变三进被知。上论期务参规总光由上世内利件系铁。业业号海说层记行走该最却么历群在。产话西写些它理才金军往拉品却圆类越众。准马单眼场知质至需律四而信经并物。', '198', '188', 'published', '2', '2');
INSERT INTO `posts` VALUES ('62', 'ecfeyuut', '深规到般行', 'http://dummyimage.com/800x600/f2c579&text=zce.me', '1972-07-16 18:38:13', '加理或因海山争量包段志习律习年证。时打织等也由石断极用被毛米历没算。该现主改号家战并实向带会它特思务开。证八住增属部状气设正难原没育什生走。机龙元说里具一布我角改即论热新所这。派太许主选家问团器合位成。那还研半育志难准走土叫地织支色战石。取业基原平布你世精系万技面任。真务电数听从习第报道海名科路论等位。低员院口心心铁她任些真求亲现般。在等号接单海志美每影标务照按提群进。热压或事器术建装声制做六共米统。适族局队层年品五声石飞资新志。', '56', '4', 'published', '2', '1');
INSERT INTO `posts` VALUES ('63', 'dciiycrrzy', '油开眼流步', 'http://dummyimage.com/800x600/7a79f2&text=zce.me', '1972-07-23 11:26:25', '值平百老合内照总经许山即已线。容统面别商把习总表周度就给色维。界更适时包传受也实管济现角者大金。美不次重点厂命使专打万化南算设。标而就据她还容革完发命认设却少出治把。克党委南算场门思即合百列制步见得矿。作斗手安统新两表果着只京组出及用。提不习进转压术分是得议市重它文族。土算格们相解表入基听了界况给四置。会设证相车型为类原常往党集从你。化电该们书米通四听去同把术。', '77', '195', 'published', '1', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `status` varchar(20) NOT NULL COMMENT '???unactivated/activated/forbidden/trashed?',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin@zce.me', 'wanglei', '芳芳', 'uploads/avatar.jpg', null, 'activated');
INSERT INTO `users` VALUES ('2', 'zce', 'w@zce.me', 'wanglei', '飞飞', 'uploads/avatar.jpg', null, 'activated');
INSERT INTO `users` VALUES ('3', 'ice', 'ice@wedn.net', 'wanglei', '亮亮', 'uploads/avatar.jpg', null, 'activated');
INSERT INTO `users` VALUES ('5', 'cg', 'itcast@itcast.cn', '123', '大春哥', 'uploads/dog.jpg', null, 'activated');
