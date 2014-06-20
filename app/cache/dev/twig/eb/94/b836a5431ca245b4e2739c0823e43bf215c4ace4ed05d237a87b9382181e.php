<?php

/* SensioDistributionBundle::Configurator/layout.html.twig */
class __TwigTemplate_eb94b836a5431ca245b4e2739c0823e43bf215c4ace4ed05d237a87b9382181e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sensiodistribution/webconfigurator/css/configurator.css"), "html", null, true);
        echo "\" />
";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        echo "Web Configurator Bundle";
    }

    // line 9
    public function block_body($context, array $blocks = array())
    {
        // line 10
        echo "    <div class=\"block\">
        ";
        // line 11
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "    </div>
    <div class=\"version\">Symfony Standard Edition v.";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["version"]) ? $context["version"] : $this->getContext($context, "version")), "html", null, true);
        echo "</div>
";
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle::Configurator/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1074 => 304,  1067 => 299,  1056 => 293,  1053 => 292,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  964 => 255,  961 => 254,  958 => 253,  952 => 251,  950 => 250,  939 => 243,  936 => 242,  934 => 241,  931 => 240,  920 => 235,  918 => 234,  915 => 233,  903 => 229,  900 => 228,  897 => 227,  894 => 226,  892 => 225,  889 => 224,  881 => 220,  878 => 219,  876 => 218,  873 => 217,  865 => 213,  860 => 211,  857 => 210,  849 => 206,  846 => 205,  841 => 203,  833 => 199,  825 => 196,  817 => 192,  814 => 191,  809 => 189,  801 => 185,  798 => 184,  793 => 182,  785 => 178,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  756 => 165,  753 => 164,  751 => 163,  739 => 156,  729 => 155,  721 => 153,  715 => 151,  712 => 150,  707 => 148,  699 => 142,  697 => 141,  695 => 139,  689 => 137,  683 => 135,  680 => 134,  675 => 132,  666 => 126,  662 => 125,  658 => 124,  654 => 123,  643 => 120,  638 => 118,  635 => 117,  619 => 113,  617 => 112,  614 => 111,  598 => 107,  596 => 106,  593 => 105,  576 => 101,  564 => 99,  557 => 96,  555 => 95,  550 => 94,  547 => 93,  524 => 90,  515 => 85,  512 => 84,  509 => 83,  503 => 81,  501 => 80,  496 => 79,  493 => 78,  490 => 77,  478 => 74,  470 => 73,  467 => 72,  464 => 71,  459 => 69,  456 => 68,  450 => 64,  442 => 62,  433 => 60,  428 => 59,  426 => 58,  414 => 52,  405 => 49,  400 => 47,  390 => 43,  388 => 42,  385 => 41,  366 => 33,  344 => 24,  332 => 20,  316 => 16,  311 => 14,  299 => 8,  266 => 366,  263 => 365,  260 => 363,  250 => 341,  245 => 335,  225 => 298,  215 => 280,  212 => 279,  146 => 181,  129 => 148,  126 => 147,  124 => 132,  306 => 286,  20 => 1,  34 => 4,  174 => 217,  167 => 71,  118 => 49,  389 => 160,  386 => 159,  378 => 157,  367 => 339,  363 => 32,  358 => 151,  345 => 147,  343 => 146,  340 => 145,  334 => 141,  331 => 140,  326 => 138,  321 => 135,  307 => 128,  302 => 125,  296 => 121,  290 => 5,  288 => 4,  265 => 105,  259 => 103,  255 => 353,  253 => 342,  222 => 297,  184 => 233,  175 => 58,  127 => 35,  403 => 48,  391 => 133,  382 => 131,  377 => 37,  371 => 35,  359 => 123,  356 => 122,  353 => 328,  350 => 26,  347 => 119,  333 => 115,  328 => 139,  324 => 112,  313 => 15,  308 => 13,  281 => 409,  274 => 110,  237 => 91,  234 => 90,  232 => 88,  210 => 270,  186 => 239,  180 => 70,  161 => 202,  155 => 47,  152 => 46,  114 => 111,  792 => 488,  775 => 485,  749 => 162,  746 => 161,  727 => 476,  710 => 149,  706 => 473,  694 => 138,  690 => 469,  679 => 466,  677 => 465,  660 => 464,  649 => 122,  634 => 456,  629 => 454,  625 => 453,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 92,  522 => 406,  517 => 404,  202 => 266,  188 => 76,  170 => 56,  76 => 31,  58 => 13,  462 => 202,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 50,  401 => 135,  394 => 134,  380 => 158,  373 => 156,  361 => 152,  351 => 141,  348 => 140,  342 => 23,  338 => 116,  335 => 21,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  303 => 122,  300 => 121,  286 => 112,  275 => 105,  270 => 102,  267 => 101,  256 => 96,  248 => 336,  233 => 304,  226 => 84,  216 => 79,  213 => 78,  207 => 269,  200 => 72,  197 => 249,  194 => 248,  191 => 246,  185 => 75,  181 => 232,  178 => 59,  172 => 57,  153 => 69,  150 => 55,  134 => 161,  84 => 41,  70 => 24,  1077 => 305,  1073 => 656,  1069 => 654,  1064 => 298,  1055 => 648,  1051 => 291,  1048 => 290,  1044 => 645,  1035 => 639,  1026 => 633,  1023 => 632,  1021 => 631,  1018 => 630,  1013 => 627,  1004 => 266,  1000 => 623,  997 => 622,  993 => 621,  984 => 615,  975 => 609,  972 => 608,  970 => 257,  967 => 256,  963 => 604,  959 => 602,  955 => 252,  947 => 249,  941 => 595,  937 => 593,  935 => 592,  930 => 590,  926 => 589,  923 => 236,  919 => 587,  911 => 581,  909 => 580,  905 => 579,  896 => 573,  893 => 572,  891 => 571,  888 => 570,  884 => 568,  880 => 566,  874 => 562,  870 => 560,  864 => 558,  862 => 212,  854 => 552,  848 => 548,  844 => 204,  838 => 544,  836 => 543,  830 => 198,  828 => 197,  824 => 537,  815 => 531,  812 => 190,  810 => 492,  807 => 491,  800 => 523,  796 => 183,  790 => 519,  788 => 486,  780 => 176,  774 => 509,  770 => 507,  764 => 169,  762 => 504,  754 => 499,  745 => 493,  742 => 492,  740 => 491,  737 => 490,  732 => 487,  724 => 154,  718 => 482,  705 => 480,  702 => 472,  698 => 471,  696 => 140,  692 => 474,  686 => 468,  682 => 467,  678 => 133,  676 => 467,  671 => 465,  668 => 464,  664 => 463,  655 => 457,  646 => 451,  642 => 449,  640 => 119,  636 => 446,  628 => 444,  626 => 443,  622 => 452,  616 => 440,  603 => 439,  591 => 436,  587 => 434,  578 => 432,  574 => 431,  565 => 430,  563 => 429,  559 => 427,  553 => 425,  551 => 424,  546 => 423,  542 => 421,  536 => 419,  534 => 418,  530 => 417,  527 => 91,  514 => 415,  297 => 200,  293 => 6,  289 => 113,  280 => 194,  276 => 393,  271 => 374,  262 => 93,  251 => 182,  249 => 92,  90 => 27,  65 => 11,  77 => 20,  113 => 48,  81 => 30,  165 => 83,  160 => 51,  137 => 27,  104 => 90,  100 => 36,  53 => 11,  480 => 75,  474 => 161,  469 => 158,  461 => 70,  457 => 153,  453 => 199,  444 => 149,  440 => 148,  437 => 61,  435 => 146,  430 => 144,  427 => 143,  423 => 57,  413 => 141,  409 => 132,  407 => 138,  402 => 130,  398 => 129,  393 => 126,  387 => 164,  384 => 121,  381 => 120,  379 => 119,  374 => 36,  368 => 34,  365 => 125,  362 => 124,  360 => 109,  355 => 27,  341 => 117,  337 => 22,  322 => 101,  314 => 99,  312 => 130,  309 => 129,  305 => 108,  298 => 120,  294 => 90,  285 => 3,  283 => 115,  278 => 408,  268 => 373,  264 => 84,  258 => 354,  252 => 80,  247 => 78,  241 => 93,  229 => 87,  220 => 290,  214 => 69,  177 => 69,  169 => 210,  140 => 55,  132 => 51,  128 => 42,  107 => 14,  61 => 2,  273 => 392,  269 => 107,  254 => 92,  243 => 327,  240 => 326,  238 => 312,  235 => 311,  230 => 303,  227 => 301,  224 => 71,  221 => 80,  219 => 76,  217 => 289,  208 => 76,  204 => 267,  179 => 224,  159 => 196,  143 => 56,  135 => 46,  119 => 117,  102 => 30,  71 => 19,  67 => 16,  63 => 21,  59 => 17,  38 => 6,  94 => 57,  89 => 35,  85 => 23,  75 => 24,  68 => 12,  56 => 12,  26 => 6,  28 => 3,  201 => 74,  196 => 92,  183 => 71,  171 => 216,  166 => 209,  163 => 53,  158 => 80,  156 => 195,  151 => 188,  142 => 59,  138 => 56,  136 => 168,  121 => 131,  117 => 37,  105 => 25,  91 => 56,  62 => 14,  49 => 14,  93 => 28,  88 => 32,  78 => 18,  24 => 3,  27 => 7,  87 => 26,  46 => 34,  44 => 11,  31 => 3,  25 => 3,  21 => 2,  19 => 1,  79 => 32,  72 => 18,  69 => 21,  47 => 9,  40 => 8,  37 => 7,  22 => 2,  246 => 96,  157 => 56,  145 => 74,  139 => 169,  131 => 160,  123 => 61,  120 => 31,  115 => 43,  111 => 110,  108 => 33,  101 => 89,  98 => 29,  96 => 67,  83 => 31,  74 => 20,  66 => 12,  55 => 12,  52 => 12,  50 => 10,  43 => 12,  41 => 7,  35 => 5,  32 => 4,  29 => 3,  209 => 82,  203 => 73,  199 => 265,  193 => 73,  189 => 240,  187 => 84,  182 => 87,  176 => 223,  173 => 85,  168 => 61,  164 => 203,  162 => 59,  154 => 189,  149 => 182,  147 => 43,  144 => 176,  141 => 175,  133 => 45,  130 => 46,  125 => 51,  122 => 43,  116 => 116,  112 => 42,  109 => 105,  106 => 104,  103 => 32,  99 => 68,  95 => 34,  92 => 28,  86 => 46,  82 => 28,  80 => 29,  73 => 24,  64 => 11,  60 => 20,  57 => 20,  54 => 15,  51 => 37,  48 => 16,  45 => 9,  42 => 13,  39 => 10,  36 => 5,  33 => 4,  30 => 3,);
    }
}
