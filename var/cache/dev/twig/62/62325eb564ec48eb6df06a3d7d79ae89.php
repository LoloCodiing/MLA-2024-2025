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

/* home/index.html.twig */
class __TwigTemplate_a9b03f3b095e93575541864276fa1f80 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Tableau Excel</title>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js\"></script>
    <link rel=\"stylesheet\" href=\"style.css\" />
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js\"></script>
</head>
<body>

    <h1>Tableau Excel</h1>

    <input type=\"file\" id=\"input\" />
    <button onclick=\"downloadExcel()\">Télécharger Excel</button>

    <table id=\"table\"></table>

    <script src=\"js/script.js\">
\t</script>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "home/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Tableau Excel</title>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js\"></script>
    <link rel=\"stylesheet\" href=\"style.css\" />
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js\"></script>
</head>
<body>

    <h1>Tableau Excel</h1>

    <input type=\"file\" id=\"input\" />
    <button onclick=\"downloadExcel()\">Télécharger Excel</button>

    <table id=\"table\"></table>

    <script src=\"js/script.js\">
\t</script>
</body>
</html>", "home/index.html.twig", "/home/lucas/ProjetLabo_Exel/templates/home/index.html.twig");
    }
}
