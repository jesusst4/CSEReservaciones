<?php

/* ::base.html.twig */
class __TwigTemplate_6927731c38d0dc3103188ccba9b2bac05a4f8502aa8e949f7a164efaad18ae7b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'menu' => array($this, 'block_menu'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>                

        ";
        // line 7
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "
        ";
        // line 13
        $this->displayBlock('menu', $context, $blocks);
        // line 47
        echo "
    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
</head>
<body>
";
        // line 51
        $this->displayBlock('body', $context, $blocks);
        // line 53
        $this->displayBlock('javascripts', $context, $blocks);
        // line 54
        echo "</body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Hotel las Brisas del Pacífico";
    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 8
        echo "            ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "e8bee49_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_0") : $this->env->getExtension('assets')->getAssetUrl("css/e8bee49_part_1_contenedor_1.css");
            // line 9
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
            ";
            // asset "e8bee49_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_1") : $this->env->getExtension('assets')->getAssetUrl("css/e8bee49_part_1_encabezado_2.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
            ";
            // asset "e8bee49_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_2") : $this->env->getExtension('assets')->getAssetUrl("css/e8bee49_part_1_menu_3.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
            ";
        } else {
            // asset "e8bee49"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49") : $this->env->getExtension('assets')->getAssetUrl("css/e8bee49.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
            ";
        }
        unset($context["asset_url"]);
        // line 11
        echo "        ";
    }

    // line 13
    public function block_menu($context, array $blocks = array())
    {
        // line 14
        echo "        <div class=\"divEncabezado\">
            <div class=\"divLogin\">
                
                <span> <label> Usuario:</label>
                    <input type=\"text\" name=\"txtUsuario\" placeholder=\"usuario\"/></span>
                <span><label> Contraseña:</label>
                    <input type=\"text\" name=\"txtContrasenia\" placeholder=\"contraseña\"/></span>
            </div>
        </div>
        <div class=\"divBanner\">
            ";
        // line 24
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "3f8a39b_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_3f8a39b_0") : $this->env->getExtension('assets')->getAssetUrl("images/3f8a39b_part_1_banner_1");
            // line 25
            echo "            <img class=\"divBanner\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" alt=\"banner\"/>
            ";
        } else {
            // asset "3f8a39b"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_3f8a39b") : $this->env->getExtension('assets')->getAssetUrl("images/3f8a39b");
            echo "            <img class=\"divBanner\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" alt=\"banner\"/>
            ";
        }
        unset($context["asset_url"]);
        // line 27
        echo "            
        </div>
        <ul id=\"menu-horizontal\">
            <li><a href=\"index.php\" title=\"Texto\">Inicio</a></li>
            <li><a href=\"HabitacionView.php\" title=\"Texto\">Habitaciones</a></li>
            <li><a href=\"ServicioView.php\" title=\"Texto\">Servicios</a></li>
            <li><a href=\"ActividadView.php\" title=\"Texto\">Actividades</a></li>

            <li><a href = \"#\" title = \"Texto\">Reservaciones</a>
                <ul>
                    <li><a href = \"ReservacionCrear.php\" title = \"Texto\">Crear</a></li>
                   
                    <li><a href = \"ReservacionBuscar.php\" title = \"Texto\">Buscar</a></li>
                    <li><a href = \"ReservacionListado.php\" title = \"Texto\">Ver Listado</a></li>
                    <li><a href = \"ReservacionGanancias.php\" title = \"Texto\">Ganacias</a></li>
                   
                </ul>
            </li>
        </ul>
    ";
    }

    // line 51
    public function block_body($context, array $blocks = array())
    {
    }

    // line 53
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 53,  160 => 51,  137 => 27,  104 => 13,  100 => 11,  74 => 9,  53 => 53,  37 => 12,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 86,  268 => 85,  264 => 84,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 70,  214 => 69,  177 => 65,  169 => 60,  140 => 55,  132 => 51,  128 => 49,  111 => 37,  107 => 14,  61 => 13,  273 => 96,  269 => 94,  254 => 92,  246 => 90,  243 => 88,  240 => 86,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 77,  219 => 76,  217 => 75,  208 => 68,  204 => 72,  179 => 69,  159 => 61,  143 => 56,  135 => 53,  131 => 52,  119 => 24,  108 => 36,  102 => 32,  71 => 19,  67 => 15,  63 => 15,  59 => 14,  47 => 9,  38 => 6,  94 => 28,  89 => 20,  85 => 25,  79 => 18,  75 => 17,  68 => 14,  56 => 9,  50 => 10,  26 => 6,  28 => 4,  201 => 92,  196 => 90,  183 => 82,  171 => 61,  166 => 71,  163 => 62,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 54,  136 => 56,  123 => 25,  121 => 46,  117 => 44,  115 => 43,  105 => 40,  101 => 32,  91 => 27,  69 => 8,  62 => 23,  49 => 19,  98 => 31,  93 => 28,  88 => 6,  78 => 21,  32 => 4,  43 => 6,  40 => 13,  22 => 2,  24 => 1,  27 => 4,  87 => 25,  72 => 16,  66 => 7,  55 => 54,  46 => 7,  44 => 12,  41 => 7,  31 => 5,  25 => 3,  35 => 7,  29 => 3,  21 => 2,  19 => 1,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 84,  182 => 66,  176 => 64,  173 => 65,  168 => 72,  164 => 59,  162 => 59,  154 => 58,  149 => 51,  147 => 58,  144 => 49,  141 => 48,  133 => 55,  130 => 41,  125 => 44,  122 => 43,  116 => 41,  112 => 42,  109 => 34,  106 => 33,  103 => 32,  99 => 31,  95 => 28,  92 => 21,  86 => 28,  82 => 22,  80 => 41,  73 => 19,  64 => 17,  60 => 5,  57 => 11,  54 => 10,  51 => 51,  48 => 13,  45 => 48,  42 => 47,  39 => 9,  36 => 5,  33 => 4,  30 => 5,);
    }
}
