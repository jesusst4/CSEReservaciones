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
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/e8bee49_part_1_contenedor_1.css");
            // line 9
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
            // asset "e8bee49_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/e8bee49_part_1_encabezado_2.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
            // asset "e8bee49_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/e8bee49_part_1_menu_3.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
        } else {
            // asset "e8bee49"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_e8bee49") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/e8bee49.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
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
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_3f8a39b_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/3f8a39b_part_1_banner_1");
            // line 25
            echo "            <img class=\"divBanner\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" alt=\"banner\"/>
            ";
        } else {
            // asset "3f8a39b"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_3f8a39b") : $this->env->getExtension('assets')->getAssetUrl("_controller/images/3f8a39b");
            echo "            <img class=\"divBanner\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
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
        return array (  165 => 53,  160 => 51,  137 => 27,  123 => 25,  119 => 24,  107 => 14,  104 => 13,  100 => 11,  74 => 9,  69 => 8,  66 => 7,  60 => 5,  55 => 54,  53 => 53,  51 => 51,  45 => 48,  40 => 13,  37 => 12,  30 => 5,  24 => 1,  42 => 47,  35 => 7,  31 => 4,  28 => 3,);
    }
}
