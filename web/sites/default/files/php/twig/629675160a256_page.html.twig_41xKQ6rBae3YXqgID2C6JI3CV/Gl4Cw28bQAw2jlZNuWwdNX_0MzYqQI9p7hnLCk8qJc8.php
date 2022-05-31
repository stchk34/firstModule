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
class __TwigTemplate_49bf338e143a889693f04a289dc1624ebf84b962032501550f46d5de564ab7a1 extends \Twig\Template
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
        return new Source("{#
/**
 * @file
 * Bootstrap Barrio's theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 * - logo: The url of the logo image, as defined in theme settings.
 * - site_name: The name of the site. This is empty when displaying the site
 *   name has been disabled in the theme settings.
 * - site_slogan: The slogan of the site. This is empty when displaying the site
 *   slogan has been disabled in theme settings.

 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.top_header: Items for the top header region.
 * - page.top_header_form: Items for the top header form region.
 * - page.header: Items for the header region.
 * - page.header_form: Items for the header form region.
 * - page.highlighted: Items for the highlighted region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.featured_top: Items for the featured top region.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.featured_bottom_first: Items for the first featured bottom region.
 * - page.featured_bottom_second: Items for the second featured bottom region.
 * - page.featured_bottom_third: Items for the third featured bottom region.
 * - page.footer_first: Items for the first footer column.
 * - page.footer_second: Items for the second footer column.
 * - page.footer_third: Items for the third footer column.
 * - page.footer_fourth: Items for the fourth footer column.
 * - page.footer_fifth: Items for the fifth footer column.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * Theme variables:
 * - navbar_top_attributes: Items for the header region.
 * - navbar_attributes: Items for the header region.
 * - content_attributes: Items for the header region.
 * - sidebar_first_attributes: Items for the highlighted region.
 * - sidebar_second_attributes: Items for the primary menu region.
 * - sidebar_collapse: If the sidebar_first will collapse.
 *
 * @see template_preprocess_page()
 * @see bootstrap_barrio_preprocess_page()
 * @see html.html.twig
 */
#}
<div id=\"page-wrapper\">
  <div id=\"page\">
    <header id=\"header\" class=\"header\" role=\"banner\" aria-label=\"{{ 'Site header'|t}}\">
      {% block head %}
        {% if page.secondary_menu or page.top_header or page.top_header_form %}
          <nav{{ navbar_top_attributes }}>
            {% if container_navbar %}
            <div class=\"container\">
              {% endif %}
              {{ page.secondary_menu }}
              {{ page.top_header }}
              {% if page.top_header_form %}
                <div class=\"form-inline navbar-form ml-auto\">
                  {{ page.top_header_form }}
                </div>
              {% endif %}
              {% if container_navbar %}
            </div>
            {% endif %}
          </nav>
        {% endif %}
        <nav{{ navbar_attributes }}>
          {% if container_navbar %}
          <div class=\"container\">
            {% endif %}
            {{ page.header }}
            {% if page.primary_menu or page.header_form %}
              <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"{{ navbar_collapse_btn_data }}\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>
              <div class=\"{{ navbar_collapse_class }}\" id=\"CollapsingNavbar\">
                {% if navbar_offcanvas %}
                <div class=\"offcanvas-header\">
                  <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                <div class=\"offcanvas-body\">
                  {% endif %}
                  {{ page.primary_menu }}
                  {% if page.header_form %}
                    <div class=\"form-inline navbar-form justify-content-end\">
                      {{ page.header_form }}
                    </div>
                  {% endif %}
                  {% if navbar_offcanvas %}
                </div>
                {% endif %}
              </div>
            {% endif %}
            {% if sidebar_collapse %}
              <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
            {% endif %}
            {% if container_navbar %}
          </div>
          {% endif %}
        </nav>
      {% endblock %}
    </header>

    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      {% block content %}
        <div id=\"main\" class=\"{{ container }}\">
          {{ page.breadcrumb }}
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
            <main{{ content_attributes }}>
              <section class=\"section\">
                <a id=\"main-content\" tabindex=\"-1\"></a>
                {{ page.content }}
              </section>
            </main>
          </div>
        </div>
      {% endblock %}
    </div>
    <footer class=\"site-footer\">
      {% block footer %}
        <div class=\"{{ container }}\">
          {% if page.footer_first %}
            <div class=\"site-footer__top clearfix\">
              {{ page.footer_first }}
            </div>
          {% endif %}
        </div>
      {% endblock %}
    </footer>
  </div>
</div>", "themes/custom/stchk34_subtheme/templates/page.html.twig", "/var/www/web/themes/custom/stchk34_subtheme/templates/page.html.twig");
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
