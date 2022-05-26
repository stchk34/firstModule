<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/stchk34_subtheme/templates/page.html.twig */
class __TwigTemplate_d4d05a0dc3bdae9208fe5fd6e90bd973887443c0662df6d52e6509599e975e06 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 70
        echo "<div id=\"page-wrapper\">
  <div id=\"page\">
    <header id=\"header\" class=\"header\" role=\"banner\" aria-label=\"";
        // line 72
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Site header"));
        echo "\">
      ";
        // line 73
        $this->displayBlock('head', $context, $blocks);
        // line 124
        echo "    </header>

    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      ";
        // line 127
        $this->displayBlock('content', $context, $blocks);
        // line 140
        echo "    </div>
    <footer class=\"site-footer\">
      ";
        // line 142
        $this->displayBlock('footer', $context, $blocks);
        // line 151
        echo "    </footer>
  </div>
</div>";
    }

    // line 73
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 74
        echo "        ";
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 74) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 74)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 74))) {
            // line 75
            echo "          <nav";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_top_attributes"] ?? null), 75, $this->source), "html", null, true);
            echo ">
            ";
            // line 76
            if (($context["container_navbar"] ?? null)) {
                // line 77
                echo "            <div class=\"container\">
              ";
            }
            // line 79
            echo "              ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 79), 79, $this->source), "html", null, true);
            echo "
              ";
            // line 80
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 80), 80, $this->source), "html", null, true);
            echo "
              ";
            // line 81
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 81)) {
                // line 82
                echo "                <div class=\"form-inline navbar-form ml-auto\">
                  ";
                // line 83
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 83), 83, $this->source), "html", null, true);
                echo "
                </div>
              ";
            }
            // line 86
            echo "              ";
            if (($context["container_navbar"] ?? null)) {
                // line 87
                echo "            </div>
            ";
            }
            // line 89
            echo "          </nav>
        ";
        }
        // line 91
        echo "        <nav";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null), 91, $this->source), "html", null, true);
        echo ">
          ";
        // line 92
        if (($context["container_navbar"] ?? null)) {
            // line 93
            echo "          <div class=\"container\">
            ";
        }
        // line 95
        echo "            ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 95), 95, $this->source), "html", null, true);
        echo "
            ";
        // line 96
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 96) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 96))) {
            // line 97
            echo "              <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_btn_data"] ?? null), 97, $this->source), "html", null, true);
            echo "\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>
              <div class=\"";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_class"] ?? null), 98, $this->source), "html", null, true);
            echo "\" id=\"CollapsingNavbar\">
                ";
            // line 99
            if (($context["navbar_offcanvas"] ?? null)) {
                // line 100
                echo "                <div class=\"offcanvas-header\">
                  <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                <div class=\"offcanvas-body\">
                  ";
            }
            // line 105
            echo "                  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 105), 105, $this->source), "html", null, true);
            echo "
                  ";
            // line 106
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 106)) {
                // line 107
                echo "                    <div class=\"form-inline navbar-form justify-content-end\">
                      ";
                // line 108
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 108), 108, $this->source), "html", null, true);
                echo "
                    </div>
                  ";
            }
            // line 111
            echo "                  ";
            if (($context["navbar_offcanvas"] ?? null)) {
                // line 112
                echo "                </div>
                ";
            }
            // line 114
            echo "              </div>
            ";
        }
        // line 116
        echo "            ";
        if (($context["sidebar_collapse"] ?? null)) {
            // line 117
            echo "              <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
            ";
        }
        // line 119
        echo "            ";
        if (($context["container_navbar"] ?? null)) {
            // line 120
            echo "          </div>
          ";
        }
        // line 122
        echo "        </nav>
      ";
    }

    // line 127
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 128
        echo "        <div id=\"main\" class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 128, $this->source), "html", null, true);
        echo "\">
          ";
        // line 129
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 129), 129, $this->source), "html", null, true);
        echo "
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
            <main";
        // line 131
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null), 131, $this->source), "html", null, true);
        echo ">
              <section class=\"section\">
                <a id=\"main-content\" tabindex=\"-1\"></a>
                ";
        // line 134
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 134), 134, $this->source), "html", null, true);
        echo "
              </section>
            </main>
          </div>
        </div>
      ";
    }

    // line 142
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 143
        echo "        <div class=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 143, $this->source), "html", null, true);
        echo "\">
          ";
        // line 144
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 144)) {
            // line 145
            echo "            <div class=\"site-footer__top clearfix\">
              ";
            // line 146
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 146), 146, $this->source), "html", null, true);
            echo "
            </div>
          ";
        }
        // line 149
        echo "        </div>
      ";
    }

    public function getTemplateName()
    {
        return "themes/custom/stchk34_subtheme/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  252 => 149,  246 => 146,  243 => 145,  241 => 144,  236 => 143,  232 => 142,  222 => 134,  216 => 131,  211 => 129,  206 => 128,  202 => 127,  197 => 122,  193 => 120,  190 => 119,  186 => 117,  183 => 116,  179 => 114,  175 => 112,  172 => 111,  166 => 108,  163 => 107,  161 => 106,  156 => 105,  149 => 100,  147 => 99,  143 => 98,  138 => 97,  136 => 96,  131 => 95,  127 => 93,  125 => 92,  120 => 91,  116 => 89,  112 => 87,  109 => 86,  103 => 83,  100 => 82,  98 => 81,  94 => 80,  89 => 79,  85 => 77,  83 => 76,  78 => 75,  75 => 74,  71 => 73,  65 => 151,  63 => 142,  59 => 140,  57 => 127,  52 => 124,  50 => 73,  46 => 72,  42 => 70,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/stchk34_subtheme/templates/page.html.twig", "/var/www/web/themes/custom/stchk34_subtheme/templates/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("block" => 73, "if" => 74);
        static $filters = array("t" => 72, "escape" => 75);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['block', 'if'],
                ['t', 'escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
