--TEST--
Test get_html_translation_table() function : basic functionality - HTML 5
--FILE--
<?php
echo "*** Testing get_html_translation_table() : basic functionality/HTML 5 ***\n";

echo "-- with table = HTML_ENTITIES, ENT_COMPAT --\n";
$table = HTML_ENTITIES;
$tt = get_html_translation_table($table, ENT_COMPAT | ENT_HTML5, "UTF-8");
asort( $tt );
var_dump( count($tt) );
print_r( $tt );

echo "-- with table = HTML_ENTITIES, ENT_QUOTES --\n";
$table = HTML_ENTITIES;
$tt = get_html_translation_table($table, ENT_QUOTES | ENT_HTML5, "UTF-8");
var_dump( count($tt) );

echo "-- with table = HTML_ENTITIES, ENT_NOQUOTES --\n";
$table = HTML_ENTITIES;
$tt = get_html_translation_table($table, ENT_NOQUOTES | ENT_HTML5, "UTF-8");
var_dump( count($tt) );

echo "-- with table = HTML_SPECIALCHARS, ENT_COMPAT --\n";
$table = HTML_SPECIALCHARS; 
$tt = get_html_translation_table($table, ENT_COMPAT, "UTF-8");
asort( $tt );
var_dump( count($tt) );
print_r( $tt );

echo "-- with table = HTML_SPECIALCHARS, ENT_QUOTES --\n";
$table = HTML_SPECIALCHARS;
$tt = get_html_translation_table($table, ENT_QUOTES | ENT_HTML5, "UTF-8");
asort( $tt );
var_dump( $tt );

echo "-- with table = HTML_SPECIALCHARS, ENT_NOQUOTES --\n";
$table = HTML_SPECIALCHARS;
$tt = get_html_translation_table($table, ENT_NOQUOTES | ENT_HTML5, "UTF-8");
asort( $tt );
var_dump( $tt );


echo "Done\n";
?>
--EXPECT--
*** Testing get_html_translation_table() : basic functionality/HTML 5 ***
-- with table = HTML_ENTITIES, ENT_COMPAT --
int(1510)
Array
(
    [Æ] => &AElig;
    [Á] => &Aacute;
    [Ă] => &Abreve;
    [Â] => &Acirc;
    [А] => &Acy;
    [𝔄] => &Afr;
    [À] => &Agrave;
    [Α] => &Alpha;
    [Ā] => &Amacr;
    [⩓] => &And;
    [Ą] => &Aogon;
    [𝔸] => &Aopf;
    [Å] => &Aring;
    [𝒜] => &Ascr;
    [Ã] => &Atilde;
    [Ä] => &Auml;
    [⫧] => &Barv;
    [Б] => &Bcy;
    [∵] => &Because;
    [Β] => &Beta;
    [𝔅] => &Bfr;
    [𝔹] => &Bopf;
    [˘] => &Breve;
    [ℬ] => &Bscr;
    [Ч] => &CHcy;
    [Ć] => &Cacute;
    [⋒] => &Cap;
    [ⅅ] => &CapitalDifferentialD;
    [Č] => &Ccaron;
    [Ç] => &Ccedil;
    [Ĉ] => &Ccirc;
    [∰] => &Cconint;
    [Ċ] => &Cdot;
    [¸] => &Cedilla;
    [·] => &CenterDot;
    [ℭ] => &Cfr;
    [Χ] => &Chi;
    [⊙] => &CircleDot;
    [⊕] => &CirclePlus;
    [⊗] => &CircleTimes;
    [∷] => &Colon;
    [⩴] => &Colone;
    [≡] => &Congruent;
    [∮] => &ContourIntegral;
    [∐] => &Coproduct;
    [⨯] => &Cross;
    [𝒞] => &Cscr;
    [⋓] => &Cup;
    [≍] => &CupCap;
    [⤑] => &DDotrahd;
    [Ђ] => &DJcy;
    [Ѕ] => &DScy;
    [Џ] => &DZcy;
    [‡] => &Dagger;
    [↡] => &Darr;
    [⫤] => &Dashv;
    [Ď] => &Dcaron;
    [Д] => &Dcy;
    [Δ] => &Delta;
    [𝔇] => &Dfr;
    [´] => &DiacriticalAcute;
    [˝] => &DiacriticalDoubleAcute;
    [˜] => &DiacriticalTilde;
    [ⅆ] => &DifferentialD;
    [𝔻] => &Dopf;
    [⃜] => &DotDot;
    [∯] => &DoubleContourIntegral;
    [¨] => &DoubleDot;
    [⇐] => &DoubleLeftArrow;
    [⟹] => &DoubleLongRightArrow;
    [⊨] => &DoubleRightTee;
    [⇑] => &DoubleUpArrow;
    [⤓] => &DownArrowBar;
    [⇵] => &DownArrowUpArrow;
    [̑] => &DownBreve;
    [⥐] => &DownLeftRightVector;
    [⥞] => &DownLeftTeeVector;
    [⥖] => &DownLeftVectorBar;
    [⥟] => &DownRightTeeVector;
    [⥗] => &DownRightVectorBar;
    [⊤] => &DownTee;
    [↧] => &DownTeeArrow;
    [⇓] => &Downarrow;
    [𝒟] => &Dscr;
    [Đ] => &Dstrok;
    [Ŋ] => &ENG;
    [Ð] => &ETH;
    [É] => &Eacute;
    [Ě] => &Ecaron;
    [Ê] => &Ecirc;
    [Э] => &Ecy;
    [Ė] => &Edot;
    [𝔈] => &Efr;
    [È] => &Egrave;
    [Ē] => &Emacr;
    [◻] => &EmptySmallSquare;
    [▫] => &EmptyVerySmallSquare;
    [Ę] => &Eogon;
    [𝔼] => &Eopf;
    [Ε] => &Epsilon;
    [⩵] => &Equal;
    [⩳] => &Esim;
    [Η] => &Eta;
    [Ë] => &Euml;
    [∃] => &Exists;
    [Ф] => &Fcy;
    [𝔉] => &Ffr;
    [◼] => &FilledSmallSquare;
    [𝔽] => &Fopf;
    [ℱ] => &Fouriertrf;
    [Ѓ] => &GJcy;
    [Γ] => &Gamma;
    [Ϝ] => &Gammad;
    [Ğ] => &Gbreve;
    [Ģ] => &Gcedil;
    [Ĝ] => &Gcirc;
    [Г] => &Gcy;
    [Ġ] => &Gdot;
    [𝔊] => &Gfr;
    [⋙] => &Gg;
    [𝔾] => &Gopf;
    [⪢] => &GreaterGreater;
    [≳] => &GreaterTilde;
    [𝒢] => &Gscr;
    [Ъ] => &HARDcy;
    [ˇ] => &Hacek;
    [^] => &Hat;
    [Ĥ] => &Hcirc;
    [ℌ] => &Hfr;
    [ℋ] => &HilbertSpace;
    [ℍ] => &Hopf;
    [─] => &HorizontalLine;
    [Ħ] => &Hstrok;
    [≏] => &HumpEqual;
    [Е] => &IEcy;
    [Ĳ] => &IJlig;
    [Ё] => &IOcy;
    [Í] => &Iacute;
    [Î] => &Icirc;
    [И] => &Icy;
    [İ] => &Idot;
    [ℑ] => &Ifr;
    [Ì] => &Igrave;
    [Ī] => &Imacr;
    [ⅈ] => &ImaginaryI;
    [⇒] => &Implies;
    [∬] => &Int;
    [∫] => &Integral;
    [⁢] => &InvisibleTimes;
    [Į] => &Iogon;
    [𝕀] => &Iopf;
    [Ι] => &Iota;
    [Ĩ] => &Itilde;
    [І] => &Iukcy;
    [Ï] => &Iuml;
    [Ĵ] => &Jcirc;
    [Й] => &Jcy;
    [𝔍] => &Jfr;
    [𝕁] => &Jopf;
    [𝒥] => &Jscr;
    [Ј] => &Jsercy;
    [Є] => &Jukcy;
    [Х] => &KHcy;
    [Ќ] => &KJcy;
    [Κ] => &Kappa;
    [Ķ] => &Kcedil;
    [К] => &Kcy;
    [𝔎] => &Kfr;
    [𝕂] => &Kopf;
    [𝒦] => &Kscr;
    [Љ] => &LJcy;
    [Ĺ] => &Lacute;
    [Λ] => &Lambda;
    [⟪] => &Lang;
    [↞] => &Larr;
    [Ľ] => &Lcaron;
    [Ļ] => &Lcedil;
    [Л] => &Lcy;
    [⇤] => &LeftArrowBar;
    [⟦] => &LeftDoubleBracket;
    [⥡] => &LeftDownTeeVector;
    [⥙] => &LeftDownVectorBar;
    [⌊] => &LeftFloor;
    [⥎] => &LeftRightVector;
    [↤] => &LeftTeeArrow;
    [⥚] => &LeftTeeVector;
    [⧏] => &LeftTriangleBar;
    [⊴] => &LeftTriangleEqual;
    [⥑] => &LeftUpDownVector;
    [⥠] => &LeftUpTeeVector;
    [⥘] => &LeftUpVectorBar;
    [⥒] => &LeftVectorBar;
    [⪡] => &LessLess;
    [≲] => &LessTilde;
    [𝔏] => &Lfr;
    [⋘] => &Ll;
    [Ŀ] => &Lmidot;
    [⟷] => &LongLeftRightArrow;
    [⟶] => &LongRightArrow;
    [𝕃] => &Lopf;
    [↘] => &LowerRightArrow;
    [↰] => &Lsh;
    [Ł] => &Lstrok;
    [⤅] => &Map;
    [М] => &Mcy;
    [ ] => &MediumSpace;
    [ℳ] => &Mellintrf;
    [𝔐] => &Mfr;
    [∓] => &MinusPlus;
    [𝕄] => &Mopf;
    [Μ] => &Mu;
    [Њ] => &NJcy;
    [Ń] => &Nacute;
    [Ň] => &Ncaron;
    [Ņ] => &Ncedil;
    [Н] => &Ncy;
    [
] => &NewLine;
    [𝔑] => &Nfr;
    [⁠] => &NoBreak;
    [⫬] => &Not;
    [≢] => &NotCongruent;
    [≭] => &NotCupCap;
    [≠] => &NotEqual;
    [≧̸] => &NotGreaterFullEqual;
    [≫̸] => &NotGreaterGreater;
    [≹] => &NotGreaterLess;
    [⧏̸] => &NotLeftTriangleBar;
    [≮] => &NotLess;
    [≰] => &NotLessEqual;
    [⪢̸] => &NotNestedGreaterGreater;
    [⪡̸] => &NotNestedLessLess;
    [⪯̸] => &NotPrecedesEqual;
    [⋠] => &NotPrecedesSlantEqual;
    [⧐̸] => &NotRightTriangleBar;
    [⋭] => &NotRightTriangleEqual;
    [⊏̸] => &NotSquareSubset;
    [⋢] => &NotSquareSubsetEqual;
    [⊐̸] => &NotSquareSuperset;
    [⋣] => &NotSquareSupersetEqual;
    [⊈] => &NotSubsetEqual;
    [⊁] => &NotSucceeds;
    [⪰̸] => &NotSucceedsEqual;
    [⋡] => &NotSucceedsSlantEqual;
    [≿̸] => &NotSucceedsTilde;
    [⊉] => &NotSupersetEqual;
    [≁] => &NotTilde;
    [𝒩] => &Nscr;
    [Ñ] => &Ntilde;
    [Ν] => &Nu;
    [Œ] => &OElig;
    [Ó] => &Oacute;
    [Ô] => &Ocirc;
    [О] => &Ocy;
    [Ő] => &Odblac;
    [𝔒] => &Ofr;
    [Ò] => &Ograve;
    [Ō] => &Omacr;
    [Ω] => &Omega;
    [Ο] => &Omicron;
    [𝕆] => &Oopf;
    [“] => &OpenCurlyDoubleQuote;
    [‘] => &OpenCurlyQuote;
    [⩔] => &Or;
    [𝒪] => &Oscr;
    [Ø] => &Oslash;
    [Õ] => &Otilde;
    [⨷] => &Otimes;
    [Ö] => &Ouml;
    [⏞] => &OverBrace;
    [⎴] => &OverBracket;
    [⏜] => &OverParenthesis;
    [П] => &Pcy;
    [𝔓] => &Pfr;
    [Φ] => &Phi;
    [Π] => &Pi;
    [⪻] => &Pr;
    [≼] => &PrecedesSlantEqual;
    [″] => &Prime;
    [𝒫] => &Pscr;
    [Ψ] => &Psi;
    [𝔔] => &Qfr;
    [𝒬] => &Qscr;
    [Ŕ] => &Racute;
    [⟫] => &Rang;
    [⤖] => &Rarrtl;
    [Ř] => &Rcaron;
    [Ŗ] => &Rcedil;
    [Р] => &Rcy;
    [∋] => &ReverseElement;
    [⥯] => &ReverseUpEquilibrium;
    [ℜ] => &Rfr;
    [Ρ] => &Rho;
    [⟩] => &RightAngleBracket;
    [⇥] => &RightArrowBar;
    [⌉] => &RightCeiling;
    [⟧] => &RightDoubleBracket;
    [⥝] => &RightDownTeeVector;
    [⇂] => &RightDownVector;
    [⥕] => &RightDownVectorBar;
    [⌋] => &RightFloor;
    [⥛] => &RightTeeVector;
    [⧐] => &RightTriangleBar;
    [⊵] => &RightTriangleEqual;
    [⥏] => &RightUpDownVector;
    [⥜] => &RightUpTeeVector;
    [↾] => &RightUpVector;
    [⥔] => &RightUpVectorBar;
    [⥓] => &RightVectorBar;
    [ℝ] => &Ropf;
    [⥰] => &RoundImplies;
    [⧴] => &RuleDelayed;
    [Щ] => &SHCHcy;
    [Ш] => &SHcy;
    [Ь] => &SOFTcy;
    [Ś] => &Sacute;
    [⪼] => &Sc;
    [Š] => &Scaron;
    [Ş] => &Scedil;
    [Ŝ] => &Scirc;
    [С] => &Scy;
    [𝔖] => &Sfr;
    [Σ] => &Sigma;
    [𝕊] => &Sopf;
    [√] => &Sqrt;
    [□] => &Square;
    [⊑] => &SquareSubsetEqual;
    [⊒] => &SquareSupersetEqual;
    [𝒮] => &Sscr;
    [⋆] => &Star;
    [⋐] => &Sub;
    [⊆] => &SubsetEqual;
    [⪰] => &SucceedsEqual;
    [≿] => &SucceedsTilde;
    [⋑] => &Supset;
    [Þ] => &THORN;
    [Ћ] => &TSHcy;
    [Ц] => &TScy;
    [	] => &Tab;
    [Τ] => &Tau;
    [Ť] => &Tcaron;
    [Ţ] => &Tcedil;
    [Т] => &Tcy;
    [𝔗] => &Tfr;
    [Θ] => &Theta;
    [  ] => &ThickSpace;
    [ ] => &ThinSpace;
    [≅] => &TildeFullEqual;
    [𝕋] => &Topf;
    [⃛] => &TripleDot;
    [𝒯] => &Tscr;
    [Ŧ] => &Tstrok;
    [Ú] => &Uacute;
    [↟] => &Uarr;
    [⥉] => &Uarrocir;
    [Ў] => &Ubrcy;
    [Ŭ] => &Ubreve;
    [Û] => &Ucirc;
    [У] => &Ucy;
    [Ű] => &Udblac;
    [𝔘] => &Ufr;
    [Ù] => &Ugrave;
    [Ū] => &Umacr;
    [⏟] => &UnderBrace;
    [⏝] => &UnderParenthesis;
    [⊎] => &UnionPlus;
    [Ų] => &Uogon;
    [𝕌] => &Uopf;
    [⤒] => &UpArrowBar;
    [↕] => &UpDownArrow;
    [↥] => &UpTeeArrow;
    [⇕] => &Updownarrow;
    [↗] => &UpperRightArrow;
    [Υ] => &Upsilon;
    [Ů] => &Uring;
    [𝒰] => &Uscr;
    [Ũ] => &Utilde;
    [Ü] => &Uuml;
    [⊫] => &VDash;
    [⫫] => &Vbar;
    [В] => &Vcy;
    [⊩] => &Vdash;
    [⫦] => &Vdashl;
    [‖] => &Verbar;
    [❘] => &VerticalSeparator;
    [𝔙] => &Vfr;
    [𝕍] => &Vopf;
    [𝒱] => &Vscr;
    [⊪] => &Vvdash;
    [Ŵ] => &Wcirc;
    [𝔚] => &Wfr;
    [𝕎] => &Wopf;
    [𝒲] => &Wscr;
    [𝔛] => &Xfr;
    [Ξ] => &Xi;
    [𝕏] => &Xopf;
    [𝒳] => &Xscr;
    [Я] => &YAcy;
    [Ї] => &YIcy;
    [Ю] => &YUcy;
    [Ý] => &Yacute;
    [Ŷ] => &Ycirc;
    [Ы] => &Ycy;
    [𝔜] => &Yfr;
    [𝕐] => &Yopf;
    [𝒴] => &Yscr;
    [Ÿ] => &Yuml;
    [Ж] => &ZHcy;
    [Ź] => &Zacute;
    [Ž] => &Zcaron;
    [З] => &Zcy;
    [Ż] => &Zdot;
    [​] => &ZeroWidthSpace;
    [Ζ] => &Zeta;
    [ℨ] => &Zfr;
    [ℤ] => &Zopf;
    [𝒵] => &Zscr;
    [á] => &aacute;
    [ă] => &abreve;
    [∾] => &ac;
    [∾̳] => &acE;
    [∿] => &acd;
    [â] => &acirc;
    [а] => &acy;
    [æ] => &aelig;
    [⁡] => &af;
    [𝔞] => &afr;
    [à] => &agrave;
    [ℵ] => &aleph;
    [α] => &alpha;
    [ā] => &amacr;
    [⨿] => &amalg;
    [&] => &amp;
    [∧] => &and;
    [⩕] => &andand;
    [⩜] => &andd;
    [⩘] => &andslope;
    [⩚] => &andv;
    [⦤] => &ange;
    [∠] => &angle;
    [∡] => &angmsd;
    [⦨] => &angmsdaa;
    [⦩] => &angmsdab;
    [⦪] => &angmsdac;
    [⦫] => &angmsdad;
    [⦬] => &angmsdae;
    [⦭] => &angmsdaf;
    [⦮] => &angmsdag;
    [⦯] => &angmsdah;
    [∟] => &angrt;
    [⊾] => &angrtvb;
    [⦝] => &angrtvbd;
    [∢] => &angsph;
    [⍼] => &angzarr;
    [ą] => &aogon;
    [𝕒] => &aopf;
    [⩰] => &apE;
    [⩯] => &apacir;
    [≊] => &ape;
    [≋] => &apid;
    [≈] => &approx;
    [å] => &aring;
    [𝒶] => &ascr;
    [*] => &ast;
    [ã] => &atilde;
    [ä] => &auml;
    [∳] => &awconint;
    [⨑] => &awint;
    [⫭] => &bNot;
    [϶] => &backepsilon;
    [‵] => &backprime;
    [⋍] => &backsimeq;
    [⊽] => &barvee;
    [⌅] => &barwed;
    [⎵] => &bbrk;
    [⎶] => &bbrktbrk;
    [≌] => &bcong;
    [б] => &bcy;
    [„] => &bdquo;
    [⦰] => &bemptyv;
    [β] => &beta;
    [ℶ] => &beth;
    [≬] => &between;
    [𝔟] => &bfr;
    [⋂] => &bigcap;
    [◯] => &bigcirc;
    [⋃] => &bigcup;
    [⨁] => &bigoplus;
    [⨂] => &bigotimes;
    [⨆] => &bigsqcup;
    [▽] => &bigtriangledown;
    [△] => &bigtriangleup;
    [⨄] => &biguplus;
    [⤍] => &bkarow;
    [▴] => &blacktriangle;
    [▾] => &blacktriangledown;
    [◂] => &blacktriangleleft;
    [▸] => &blacktriangleright;
    [␣] => &blank;
    [▒] => &blk12;
    [░] => &blk14;
    [▓] => &blk34;
    [█] => &block;
    [=⃥] => &bne;
    [≡⃥] => &bnequiv;
    [⌐] => &bnot;
    [𝕓] => &bopf;
    [⋈] => &bowtie;
    [╗] => &boxDL;
    [╔] => &boxDR;
    [╖] => &boxDl;
    [╓] => &boxDr;
    [═] => &boxH;
    [╦] => &boxHD;
    [╩] => &boxHU;
    [╤] => &boxHd;
    [╧] => &boxHu;
    [╝] => &boxUL;
    [╚] => &boxUR;
    [╜] => &boxUl;
    [╙] => &boxUr;
    [║] => &boxV;
    [╬] => &boxVH;
    [╣] => &boxVL;
    [╠] => &boxVR;
    [╫] => &boxVh;
    [╢] => &boxVl;
    [╟] => &boxVr;
    [⧉] => &boxbox;
    [╕] => &boxdL;
    [╒] => &boxdR;
    [┐] => &boxdl;
    [┌] => &boxdr;
    [╥] => &boxhD;
    [╨] => &boxhU;
    [┬] => &boxhd;
    [┴] => &boxhu;
    [⊟] => &boxminus;
    [⊞] => &boxplus;
    [╛] => &boxuL;
    [╘] => &boxuR;
    [┘] => &boxul;
    [└] => &boxur;
    [│] => &boxv;
    [╪] => &boxvH;
    [╡] => &boxvL;
    [╞] => &boxvR;
    [┼] => &boxvh;
    [┤] => &boxvl;
    [├] => &boxvr;
    [¦] => &brvbar;
    [𝒷] => &bscr;
    [⁏] => &bsemi;
    [∽] => &bsim;
    [\] => &bsol;
    [⧅] => &bsolb;
    [⟈] => &bsolhsub;
    [•] => &bull;
    [≎] => &bump;
    [⪮] => &bumpE;
    [ć] => &cacute;
    [∩] => &cap;
    [⩄] => &capand;
    [⩉] => &capbrcup;
    [⩋] => &capcap;
    [⩇] => &capcup;
    [⩀] => &capdot;
    [∩︀] => &caps;
    [⁁] => &caret;
    [⩍] => &ccaps;
    [č] => &ccaron;
    [ç] => &ccedil;
    [ĉ] => &ccirc;
    [⩌] => &ccups;
    [⩐] => &ccupssm;
    [ċ] => &cdot;
    [⦲] => &cemptyv;
    [¢] => &cent;
    [𝔠] => &cfr;
    [ч] => &chcy;
    [✓] => &check;
    [χ] => &chi;
    [○] => &cir;
    [⧃] => &cirE;
    [ˆ] => &circ;
    [≗] => &circeq;
    [⨐] => &cirfnint;
    [⫯] => &cirmid;
    [⧂] => &cirscir;
    [♣] => &clubs;
    [:] => &colon;
    [≔] => &coloneq;
    [,] => &comma;
    [@] => &commat;
    [∁] => &comp;
    [∘] => &compfn;
    [ℂ] => &complexes;
    [⩭] => &congdot;
    [𝕔] => &copf;
    [©] => &copy;
    [℗] => &copysr;
    [↵] => &crarr;
    [✗] => &cross;
    [𝒸] => &cscr;
    [⫏] => &csub;
    [⫑] => &csube;
    [⫐] => &csup;
    [⫒] => &csupe;
    [⋯] => &ctdot;
    [⤸] => &cudarrl;
    [⤵] => &cudarrr;
    [⋟] => &cuesc;
    [⤽] => &cularrp;
    [∪] => &cup;
    [⩈] => &cupbrcap;
    [⩆] => &cupcap;
    [⩊] => &cupcup;
    [⊍] => &cupdot;
    [⩅] => &cupor;
    [∪︀] => &cups;
    [↷] => &curarr;
    [⤼] => &curarrm;
    [⋞] => &curlyeqprec;
    [⋎] => &curlyvee;
    [⋏] => &curlywedge;
    [¤] => &curren;
    [↶] => &curvearrowleft;
    [∲] => &cwconint;
    [∱] => &cwint;
    [⌭] => &cylcty;
    [⥥] => &dHar;
    [†] => &dagger;
    [ℸ] => &daleth;
    [↓] => &darr;
    [⊣] => &dashv;
    [⤏] => &dbkarow;
    [ď] => &dcaron;
    [д] => &dcy;
    [⩷] => &ddotseq;
    [°] => &deg;
    [δ] => &delta;
    [⦱] => &demptyv;
    [⥿] => &dfisht;
    [𝔡] => &dfr;
    [⇃] => &dharl;
    [⋄] => &diamond;
    [♦] => &diamondsuit;
    [⋲] => &disin;
    [÷] => &divide;
    [⋇] => &divonx;
    [ђ] => &djcy;
    [⌍] => &dlcrop;
    [$] => &dollar;
    [𝕕] => &dopf;
    [˙] => &dot;
    [≑] => &doteqdot;
    [⌆] => &doublebarwedge;
    [⇊] => &downdownarrows;
    [⤐] => &drbkarow;
    [⌟] => &drcorn;
    [⌌] => &drcrop;
    [𝒹] => &dscr;
    [ѕ] => &dscy;
    [⧶] => &dsol;
    [đ] => &dstrok;
    [⋱] => &dtdot;
    [⦦] => &dwangle;
    [џ] => &dzcy;
    [⟿] => &dzigrarr;
    [é] => &eacute;
    [⩮] => &easter;
    [ě] => &ecaron;
    [≖] => &ecir;
    [ê] => &ecirc;
    [э] => &ecy;
    [ė] => &edot;
    [𝔢] => &efr;
    [⪚] => &eg;
    [è] => &egrave;
    [⪖] => &egs;
    [⪘] => &egsdot;
    [⪙] => &el;
    [⏧] => &elinters;
    [ℓ] => &ell;
    [⪕] => &els;
    [⪗] => &elsdot;
    [ē] => &emacr;
    [∅] => &empty;
    [ ] => &emsp13;
    [ ] => &emsp14;
    [ ] => &emsp;
    [ŋ] => &eng;
    [ ] => &ensp;
    [ę] => &eogon;
    [𝕖] => &eopf;
    [⋕] => &epar;
    [⧣] => &eparsl;
    [⩱] => &eplus;
    [ε] => &epsi;
    [≕] => &eqcolon;
    [=] => &equals;
    [≟] => &equest;
    [⩸] => &equivDD;
    [⧥] => &eqvparsl;
    [⥱] => &erarr;
    [ℯ] => &escr;
    [≐] => &esdot;
    [≂] => &esim;
    [η] => &eta;
    [ð] => &eth;
    [ë] => &euml;
    [€] => &euro;
    [!] => &excl;
    [ℰ] => &expectation;
    [ⅇ] => &exponentiale;
    [≒] => &fallingdotseq;
    [ф] => &fcy;
    [♀] => &female;
    [ﬃ] => &ffilig;
    [ﬀ] => &fflig;
    [ﬄ] => &ffllig;
    [𝔣] => &ffr;
    [ﬁ] => &filig;
    [fj] => &fjlig;
    [♭] => &flat;
    [ﬂ] => &fllig;
    [▱] => &fltns;
    [ƒ] => &fnof;
    [𝕗] => &fopf;
    [∀] => &forall;
    [⫙] => &forkv;
    [⨍] => &fpartint;
    [⅓] => &frac13;
    [¼] => &frac14;
    [⅕] => &frac15;
    [⅙] => &frac16;
    [⅛] => &frac18;
    [⅔] => &frac23;
    [⅖] => &frac25;
    [¾] => &frac34;
    [⅗] => &frac35;
    [⅜] => &frac38;
    [⅘] => &frac45;
    [⅚] => &frac56;
    [⅝] => &frac58;
    [⅞] => &frac78;
    [⁄] => &frasl;
    [⌢] => &frown;
    [𝒻] => &fscr;
    [⪌] => &gEl;
    [ǵ] => &gacute;
    [γ] => &gamma;
    [ϝ] => &gammad;
    [⪆] => &gap;
    [ğ] => &gbreve;
    [ĝ] => &gcirc;
    [г] => &gcy;
    [ġ] => &gdot;
    [≥] => &ge;
    [≧] => &geqq;
    [⩾] => &ges;
    [⪩] => &gescc;
    [⪀] => &gesdot;
    [⪂] => &gesdoto;
    [⪄] => &gesdotol;
    [⋛︀] => &gesl;
    [⪔] => &gesles;
    [𝔤] => &gfr;
    [≫] => &gg;
    [ℷ] => &gimel;
    [ѓ] => &gjcy;
    [≷] => &gl;
    [⪒] => &glE;
    [⪥] => &gla;
    [⪤] => &glj;
    [⪊] => &gnap;
    [⪈] => &gne;
    [≩] => &gneqq;
    [⋧] => &gnsim;
    [𝕘] => &gopf;
    [`] => &grave;
    [ℊ] => &gscr;
    [⪎] => &gsime;
    [⪐] => &gsiml;
    [>] => &gt;
    [⪧] => &gtcc;
    [⩺] => &gtcir;
    [⦕] => &gtlPar;
    [⩼] => &gtquest;
    [⥸] => &gtrarr;
    [⋗] => &gtrdot;
    [⋛] => &gtreqless;
    [≩︀] => &gvertneqq;
    [⇔] => &hArr;
    [ ] => &hairsp;
    [½] => &half;
    [ъ] => &hardcy;
    [↔] => &harr;
    [⥈] => &harrcir;
    [↭] => &harrw;
    [ĥ] => &hcirc;
    [♥] => &hearts;
    […] => &hellip;
    [⊹] => &hercon;
    [𝔥] => &hfr;
    [⇿] => &hoarr;
    [∻] => &homtht;
    [𝕙] => &hopf;
    [―] => &horbar;
    [𝒽] => &hscr;
    [ħ] => &hstrok;
    [⁃] => &hybull;
    [‐] => &hyphen;
    [í] => &iacute;
    [⁣] => &ic;
    [î] => &icirc;
    [и] => &icy;
    [е] => &iecy;
    [¡] => &iexcl;
    [𝔦] => &ifr;
    [ì] => &igrave;
    [⨌] => &iiiint;
    [⧜] => &iinfin;
    [℩] => &iiota;
    [ĳ] => &ijlig;
    [ī] => &imacr;
    [ℐ] => &imagline;
    [⊷] => &imof;
    [Ƶ] => &imped;
    [℅] => &incare;
    [∞] => &infin;
    [⧝] => &infintie;
    [ı] => &inodot;
    [⊺] => &intcal;
    [⨗] => &intlarhk;
    [ё] => &iocy;
    [į] => &iogon;
    [𝕚] => &iopf;
    [ι] => &iota;
    [⨼] => &iprod;
    [¿] => &iquest;
    [𝒾] => &iscr;
    [⋹] => &isinE;
    [⋵] => &isindot;
    [⋴] => &isins;
    [⋳] => &isinsv;
    [∈] => &isinv;
    [ĩ] => &itilde;
    [і] => &iukcy;
    [ï] => &iuml;
    [ĵ] => &jcirc;
    [й] => &jcy;
    [𝔧] => &jfr;
    [ȷ] => &jmath;
    [𝕛] => &jopf;
    [𝒿] => &jscr;
    [ј] => &jsercy;
    [є] => &jukcy;
    [κ] => &kappa;
    [ķ] => &kcedil;
    [к] => &kcy;
    [𝔨] => &kfr;
    [ĸ] => &kgreen;
    [х] => &khcy;
    [ќ] => &kjcy;
    [𝕜] => &kopf;
    [𝓀] => &kscr;
    [⇚] => &lAarr;
    [⤛] => &lAtail;
    [⤎] => &lBarr;
    [≦] => &lE;
    [⥢] => &lHar;
    [ĺ] => &lacute;
    [⦴] => &laemptyv;
    [ℒ] => &lagran;
    [λ] => &lambda;
    [⦑] => &langd;
    [⟨] => &langle;
    [⪅] => &lap;
    [«] => &laquo;
    [←] => &larr;
    [⤟] => &larrbfs;
    [⤝] => &larrfs;
    [↩] => &larrhk;
    [↫] => &larrlp;
    [⤹] => &larrpl;
    [⥳] => &larrsim;
    [↢] => &larrtl;
    [⪫] => &lat;
    [⤙] => &latail;
    [⪭] => &late;
    [⪭︀] => &lates;
    [⤌] => &lbarr;
    [❲] => &lbbrk;
    [{] => &lbrace;
    [[] => &lbrack;
    [⦋] => &lbrke;
    [⦏] => &lbrksld;
    [⦍] => &lbrkslu;
    [ľ] => &lcaron;
    [ļ] => &lcedil;
    [⌈] => &lceil;
    [л] => &lcy;
    [⤶] => &ldca;
    [⥧] => &ldrdhar;
    [⥋] => &ldrushar;
    [↲] => &ldsh;
    [↽] => &leftharpoondown;
    [↼] => &leftharpoonup;
    [⇋] => &leftrightharpoons;
    [≤] => &leq;
    [⩽] => &les;
    [⪨] => &lescc;
    [⩿] => &lesdot;
    [⪁] => &lesdoto;
    [⪃] => &lesdotor;
    [⋚︀] => &lesg;
    [⪓] => &lesges;
    [⋖] => &lessdot;
    [⋚] => &lesseqgtr;
    [⪋] => &lesseqqgtr;
    [≶] => &lessgtr;
    [⥼] => &lfisht;
    [𝔩] => &lfr;
    [⪑] => &lgE;
    [⥪] => &lharul;
    [▄] => &lhblk;
    [љ] => &ljcy;
    [≪] => &ll;
    [⇇] => &llarr;
    [⌞] => &llcorner;
    [⥫] => &llhard;
    [◺] => &lltri;
    [ŀ] => &lmidot;
    [⎰] => &lmoust;
    [⪉] => &lnap;
    [⪇] => &lne;
    [≨] => &lneqq;
    [⋦] => &lnsim;
    [⟬] => &loang;
    [⇽] => &loarr;
    [⟵] => &longleftarrow;
    [↬] => &looparrowright;
    [⦅] => &lopar;
    [𝕝] => &lopf;
    [⨭] => &loplus;
    [⨴] => &lotimes;
    [∗] => &lowast;
    [_] => &lowbar;
    [◊] => &lozenge;
    [⧫] => &lozf;
    [(] => &lpar;
    [⦓] => &lparlt;
    [⇆] => &lrarr;
    [⥭] => &lrhard;
    [‎] => &lrm;
    [⊿] => &lrtri;
    [‹] => &lsaquo;
    [𝓁] => &lscr;
    [⪍] => &lsime;
    [⪏] => &lsimg;
    [ł] => &lstrok;
    [<] => &lt;
    [⪦] => &ltcc;
    [⩹] => &ltcir;
    [⋋] => &lthree;
    [⋉] => &ltimes;
    [⥶] => &ltlarr;
    [⩻] => &ltquest;
    [⦖] => &ltrPar;
    [◃] => &ltri;
    [⥊] => &lurdshar;
    [⥦] => &luruhar;
    [≨︀] => &lvertneqq;
    [∺] => &mDDot;
    [¯] => &macr;
    [♂] => &male;
    [✠] => &maltese;
    [↦] => &map;
    [▮] => &marker;
    [⨩] => &mcomma;
    [м] => &mcy;
    [—] => &mdash;
    [𝔪] => &mfr;
    [℧] => &mho;
    [µ] => &micro;
    [∣] => &mid;
    [⫰] => &midcir;
    [−] => &minus;
    [∸] => &minusd;
    [⨪] => &minusdu;
    [⫛] => &mlcp;
    [⊧] => &models;
    [𝕞] => &mopf;
    [𝓂] => &mscr;
    [μ] => &mu;
    [⊸] => &mumap;
    [⋙̸] => &nGg;
    [≫⃒] => &nGt;
    [⇍] => &nLeftarrow;
    [⋘̸] => &nLl;
    [≪⃒] => &nLt;
    [≪̸] => &nLtv;
    [⊯] => &nVDash;
    [⊮] => &nVdash;
    [∇] => &nabla;
    [ń] => &nacute;
    [∠⃒] => &nang;
    [⩰̸] => &napE;
    [≋̸] => &napid;
    [ŉ] => &napos;
    [≉] => &napprox;
    [♮] => &natur;
    [ℕ] => &naturals;
    [ ] => &nbsp;
    [≎̸] => &nbump;
    [≏̸] => &nbumpe;
    [⩃] => &ncap;
    [ň] => &ncaron;
    [ņ] => &ncedil;
    [≇] => &ncong;
    [⩭̸] => &ncongdot;
    [⩂] => &ncup;
    [н] => &ncy;
    [–] => &ndash;
    [⇗] => &neArr;
    [⤤] => &nearhk;
    [≐̸] => &nedot;
    [≂̸] => &nesim;
    [∄] => &nexist;
    [𝔫] => &nfr;
    [≱] => &ngeq;
    [⩾̸] => &nges;
    [≵] => &ngsim;
    [≯] => &ngtr;
    [⇎] => &nhArr;
    [⫲] => &nhpar;
    [⋼] => &nis;
    [⋺] => &nisd;
    [њ] => &njcy;
    [≦̸] => &nlE;
    [‥] => &nldr;
    [↚] => &nleftarrow;
    [↮] => &nleftrightarrow;
    [⩽̸] => &nles;
    [≴] => &nlsim;
    [⋪] => &nltri;
    [⋬] => &nltrie;
    [𝕟] => &nopf;
    [¬] => &not;
    [∉] => &notin;
    [⋹̸] => &notinE;
    [⋵̸] => &notindot;
    [⋷] => &notinvb;
    [⋶] => &notinvc;
    [∌] => &notniva;
    [⋾] => &notnivb;
    [⋽] => &notnivc;
    [∦] => &nparallel;
    [⫽⃥] => &nparsl;
    [∂̸] => &npart;
    [⨔] => &npolint;
    [⊀] => &npr;
    [⇏] => &nrArr;
    [↛] => &nrarr;
    [⤳̸] => &nrarrc;
    [↝̸] => &nrarrw;
    [𝓃] => &nscr;
    [∤] => &nshortmid;
    [≄] => &nsime;
    [⊄] => &nsub;
    [⫅̸] => &nsubE;
    [⊅] => &nsup;
    [⊃⃒] => &nsupset;
    [⫆̸] => &nsupseteqq;
    [ñ] => &ntilde;
    [≸] => &ntlg;
    [⋫] => &ntriangleright;
    [ν] => &nu;
    [#] => &num;
    [№] => &numero;
    [ ] => &numsp;
    [⊭] => &nvDash;
    [⤄] => &nvHarr;
    [≍⃒] => &nvap;
    [⊬] => &nvdash;
    [≥⃒] => &nvge;
    [>⃒] => &nvgt;
    [⧞] => &nvinfin;
    [⤂] => &nvlArr;
    [≤⃒] => &nvle;
    [<⃒] => &nvlt;
    [⊴⃒] => &nvltrie;
    [⤃] => &nvrArr;
    [⊵⃒] => &nvrtrie;
    [∼⃒] => &nvsim;
    [⇖] => &nwArr;
    [⤣] => &nwarhk;
    [↖] => &nwarrow;
    [⤧] => &nwnear;
    [Ⓢ] => &oS;
    [ó] => &oacute;
    [⊛] => &oast;
    [⊚] => &ocir;
    [ô] => &ocirc;
    [о] => &ocy;
    [⊝] => &odash;
    [ő] => &odblac;
    [⨸] => &odiv;
    [⦼] => &odsold;
    [œ] => &oelig;
    [⦿] => &ofcir;
    [𝔬] => &ofr;
    [˛] => &ogon;
    [ò] => &ograve;
    [⧁] => &ogt;
    [⦵] => &ohbar;
    [↺] => &olarr;
    [⦾] => &olcir;
    [⦻] => &olcross;
    [‾] => &oline;
    [⧀] => &olt;
    [ō] => &omacr;
    [ω] => &omega;
    [ο] => &omicron;
    [⦶] => &omid;
    [⊖] => &ominus;
    [𝕠] => &oopf;
    [⦷] => &opar;
    [⦹] => &operp;
    [∨] => &or;
    [↻] => &orarr;
    [⩝] => &ord;
    [ℴ] => &orderof;
    [ª] => &ordf;
    [º] => &ordm;
    [⊶] => &origof;
    [⩖] => &oror;
    [⩗] => &orslope;
    [⩛] => &orv;
    [ø] => &oslash;
    [⊘] => &osol;
    [õ] => &otilde;
    [⨶] => &otimesas;
    [ö] => &ouml;
    [⌽] => &ovbar;
    [¶] => &para;
    [⫳] => &parsim;
    [⫽] => &parsl;
    [∂] => &part;
    [п] => &pcy;
    [%] => &percnt;
    [.] => &period;
    [‰] => &permil;
    [⊥] => &perp;
    [‱] => &pertenk;
    [𝔭] => &pfr;
    [φ] => &phi;
    [☎] => &phone;
    [π] => &pi;
    [⋔] => &pitchfork;
    [ϖ] => &piv;
    [ℏ] => &planck;
    [ℎ] => &planckh;
    [+] => &plus;
    [⨣] => &plusacir;
    [⨢] => &pluscir;
    [∔] => &plusdo;
    [⨥] => &plusdu;
    [⩲] => &pluse;
    [±] => &plusmn;
    [⨦] => &plussim;
    [⨧] => &plustwo;
    [⨕] => &pointint;
    [𝕡] => &popf;
    [£] => &pound;
    [⪳] => &prE;
    [≺] => &prec;
    [⪷] => &precapprox;
    [⪯] => &preceq;
    [⪹] => &precnapprox;
    [⪵] => &precneqq;
    [⋨] => &precnsim;
    [≾] => &precsim;
    [′] => &prime;
    [ℙ] => &primes;
    [∏] => &prod;
    [⌮] => &profalar;
    [⌒] => &profline;
    [⌓] => &profsurf;
    [∝] => &prop;
    [⊰] => &prurel;
    [𝓅] => &pscr;
    [ψ] => &psi;
    [ ] => &puncsp;
    [𝔮] => &qfr;
    [𝕢] => &qopf;
    [⁗] => &qprime;
    [𝓆] => &qscr;
    [⨖] => &quatint;
    [?] => &quest;
    ["] => &quot;
    [⇛] => &rAarr;
    [⤜] => &rAtail;
    [⥤] => &rHar;
    [∽̱] => &race;
    [ŕ] => &racute;
    [⦳] => &raemptyv;
    [⦒] => &rangd;
    [⦥] => &range;
    [»] => &raquo;
    [⥵] => &rarrap;
    [⤠] => &rarrbfs;
    [⤳] => &rarrc;
    [⤞] => &rarrfs;
    [↪] => &rarrhk;
    [⥅] => &rarrpl;
    [⥴] => &rarrsim;
    [↣] => &rarrtl;
    [↝] => &rarrw;
    [⤚] => &ratail;
    [∶] => &ratio;
    [ℚ] => &rationals;
    [❳] => &rbbrk;
    [⦌] => &rbrke;
    [⦎] => &rbrksld;
    [⦐] => &rbrkslu;
    [ř] => &rcaron;
    [ŗ] => &rcedil;
    [}] => &rcub;
    [р] => &rcy;
    [⤷] => &rdca;
    [⥩] => &rdldhar;
    [”] => &rdquo;
    [↳] => &rdsh;
    [ℛ] => &realine;
    [▭] => &rect;
    [®] => &reg;
    [⥽] => &rfisht;
    [𝔯] => &rfr;
    [⇁] => &rhard;
    [⇀] => &rharu;
    [⥬] => &rharul;
    [ρ] => &rho;
    [ϱ] => &rhov;
    [⇄] => &rightleftarrows;
    [⇌] => &rightleftharpoons;
    [˚] => &ring;
    [≓] => &risingdotseq;
    [‏] => &rlm;
    [⎱] => &rmoust;
    [⫮] => &rnmid;
    [⟭] => &roang;
    [⇾] => &roarr;
    [⦆] => &ropar;
    [𝕣] => &ropf;
    [⨮] => &roplus;
    [⨵] => &rotimes;
    [)] => &rpar;
    [⦔] => &rpargt;
    [⨒] => &rppolint;
    [⇉] => &rrarr;
    [›] => &rsaquo;
    [𝓇] => &rscr;
    [↱] => &rsh;
    []] => &rsqb;
    [’] => &rsquo;
    [⋌] => &rthree;
    [⋊] => &rtimes;
    [▹] => &rtri;
    [⧎] => &rtriltri;
    [⥨] => &ruluhar;
    [℞] => &rx;
    [ś] => &sacute;
    [‚] => &sbquo;
    [⪴] => &scE;
    [š] => &scaron;
    [ş] => &scedil;
    [ŝ] => &scirc;
    [⪶] => &scnE;
    [⋩] => &scnsim;
    [⨓] => &scpolint;
    [с] => &scy;
    [⋅] => &sdot;
    [⊡] => &sdotb;
    [⩦] => &sdote;
    [⇘] => &seArr;
    [⤥] => &searhk;
    [§] => &sect;
    [;] => &semi;
    [⤩] => &seswar;
    [✶] => &sext;
    [𝔰] => &sfr;
    [♯] => &sharp;
    [щ] => &shchcy;
    [ш] => &shcy;
    [∥] => &shortparallel;
    [­] => &shy;
    [σ] => &sigma;
    [ς] => &sigmav;
    [∼] => &sim;
    [⩪] => &simdot;
    [≃] => &simeq;
    [⪞] => &simg;
    [⪠] => &simgE;
    [⪝] => &siml;
    [⪟] => &simlE;
    [≆] => &simne;
    [⨤] => &simplus;
    [⥲] => &simrarr;
    [⨳] => &smashp;
    [⧤] => &smeparsl;
    [⌣] => &smile;
    [⪪] => &smt;
    [⪬] => &smte;
    [⪬︀] => &smtes;
    [ь] => &softcy;
    [/] => &sol;
    [⧄] => &solb;
    [⌿] => &solbar;
    [𝕤] => &sopf;
    [♠] => &spadesuit;
    [⊓] => &sqcap;
    [⊓︀] => &sqcaps;
    [⊔] => &sqcup;
    [⊔︀] => &sqcups;
    [⊏] => &sqsub;
    [⊐] => &sqsupset;
    [▪] => &squarf;
    [→] => &srarr;
    [𝓈] => &sscr;
    [∖] => &ssetmn;
    [☆] => &star;
    [★] => &starf;
    [ϵ] => &straightepsilon;
    [ϕ] => &straightphi;
    [⊂] => &sub;
    [⫅] => &subE;
    [⪽] => &subdot;
    [⫃] => &subedot;
    [⫁] => &submult;
    [⪿] => &subplus;
    [⥹] => &subrarr;
    [⊊] => &subsetneq;
    [⫋] => &subsetneqq;
    [⫇] => &subsim;
    [⫕] => &subsub;
    [⫓] => &subsup;
    [≻] => &succ;
    [⪸] => &succapprox;
    [≽] => &succcurlyeq;
    [⪺] => &succnapprox;
    [∑] => &sum;
    [♪] => &sung;
    [¹] => &sup1;
    [²] => &sup2;
    [³] => &sup3;
    [⊃] => &sup;
    [⪾] => &supdot;
    [⫘] => &supdsub;
    [⊇] => &supe;
    [⫄] => &supedot;
    [⟉] => &suphsol;
    [⫗] => &suphsub;
    [⥻] => &suplarr;
    [⫂] => &supmult;
    [⫌] => &supnE;
    [⫀] => &supplus;
    [⫆] => &supseteqq;
    [⊋] => &supsetneq;
    [⫈] => &supsim;
    [⫔] => &supsub;
    [⫖] => &supsup;
    [⇙] => &swArr;
    [⤦] => &swarhk;
    [↙] => &swarr;
    [⤪] => &swnwar;
    [ß] => &szlig;
    [⌖] => &target;
    [τ] => &tau;
    [ť] => &tcaron;
    [ţ] => &tcedil;
    [т] => &tcy;
    [⌕] => &telrec;
    [𝔱] => &tfr;
    [∴] => &there4;
    [θ] => &theta;
    [ϑ] => &thetasym;
    [þ] => &thorn;
    [×] => &times;
    [⊠] => &timesb;
    [⨱] => &timesbar;
    [⨰] => &timesd;
    [∭] => &tint;
    [⤨] => &toea;
    [⌶] => &topbot;
    [⫱] => &topcir;
    [𝕥] => &topf;
    [⫚] => &topfork;
    [‴] => &tprime;
    [™] => &trade;
    [▵] => &triangle;
    [▿] => &triangledown;
    [≜] => &triangleq;
    [◬] => &tridot;
    [⨺] => &triminus;
    [⨹] => &triplus;
    [⧍] => &trisb;
    [⨻] => &tritime;
    [⏢] => &trpezium;
    [𝓉] => &tscr;
    [ц] => &tscy;
    [ћ] => &tshcy;
    [ŧ] => &tstrok;
    [↠] => &twoheadrightarrow;
    [⥣] => &uHar;
    [ú] => &uacute;
    [↑] => &uarr;
    [ў] => &ubrcy;
    [ŭ] => &ubreve;
    [û] => &ucirc;
    [у] => &ucy;
    [⇅] => &udarr;
    [ű] => &udblac;
    [⥮] => &udhar;
    [⥾] => &ufisht;
    [𝔲] => &ufr;
    [ù] => &ugrave;
    [↿] => &uharl;
    [▀] => &uhblk;
    [⌜] => &ulcorner;
    [⌏] => &ulcrop;
    [◸] => &ultri;
    [ū] => &umacr;
    [ų] => &uogon;
    [𝕦] => &uopf;
    [υ] => &upsi;
    [ϒ] => &upsih;
    [⇈] => &upuparrows;
    [⌝] => &urcorner;
    [⌎] => &urcrop;
    [ů] => &uring;
    [◹] => &urtri;
    [𝓊] => &uscr;
    [⋰] => &utdot;
    [ũ] => &utilde;
    [ü] => &uuml;
    [⦧] => &uwangle;
    [⫨] => &vBar;
    [⫩] => &vBarv;
    [⦜] => &vangrt;
    [ϰ] => &varkappa;
    [⫌︀] => &varsupsetneqq;
    [⊲] => &vartriangleleft;
    [в] => &vcy;
    [⊢] => &vdash;
    [⊻] => &veebar;
    [≚] => &veeeq;
    [⋮] => &vellip;
    [|] => &vert;
    [𝔳] => &vfr;
    [⊂⃒] => &vnsub;
    [𝕧] => &vopf;
    [⊳] => &vrtri;
    [𝓋] => &vscr;
    [⫋︀] => &vsubnE;
    [⊊︀] => &vsubne;
    [⊋︀] => &vsupne;
    [⦚] => &vzigzag;
    [ŵ] => &wcirc;
    [⩟] => &wedbar;
    [≙] => &wedgeq;
    [𝔴] => &wfr;
    [𝕨] => &wopf;
    [℘] => &wp;
    [≀] => &wr;
    [𝓌] => &wscr;
    [𝔵] => &xfr;
    [⟺] => &xhArr;
    [ξ] => &xi;
    [⟸] => &xlArr;
    [⟼] => &xmap;
    [⋻] => &xnis;
    [⨀] => &xodot;
    [𝕩] => &xopf;
    [𝓍] => &xscr;
    [⋁] => &xvee;
    [⋀] => &xwedge;
    [ý] => &yacute;
    [я] => &yacy;
    [ŷ] => &ycirc;
    [ы] => &ycy;
    [¥] => &yen;
    [𝔶] => &yfr;
    [ї] => &yicy;
    [𝕪] => &yopf;
    [𝓎] => &yscr;
    [ю] => &yucy;
    [ÿ] => &yuml;
    [ź] => &zacute;
    [ž] => &zcaron;
    [з] => &zcy;
    [ż] => &zdot;
    [ζ] => &zeta;
    [𝔷] => &zfr;
    [ж] => &zhcy;
    [⇝] => &zigrarr;
    [𝕫] => &zopf;
    [𝓏] => &zscr;
    [‍] => &zwj;
    [‌] => &zwnj;
)
-- with table = HTML_ENTITIES, ENT_QUOTES --
int(1511)
-- with table = HTML_ENTITIES, ENT_NOQUOTES --
int(1509)
-- with table = HTML_SPECIALCHARS, ENT_COMPAT --
int(4)
Array
(
    [&] => &amp;
    [>] => &gt;
    [<] => &lt;
    ["] => &quot;
)
-- with table = HTML_SPECIALCHARS, ENT_QUOTES --
array(5) {
  ["&"]=>
  string(5) "&amp;"
  ["'"]=>
  string(6) "&apos;"
  [">"]=>
  string(4) "&gt;"
  ["<"]=>
  string(4) "&lt;"
  ["""]=>
  string(6) "&quot;"
}
-- with table = HTML_SPECIALCHARS, ENT_NOQUOTES --
array(3) {
  ["&"]=>
  string(5) "&amp;"
  [">"]=>
  string(4) "&gt;"
  ["<"]=>
  string(4) "&lt;"
}
Done