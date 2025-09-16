<main class="agend">
    <h2 class="agend__heading">Sugerencias de herramientas</h2>
    <p class="speakers__description">Optimiza tu trabajo: Herramientas para aumentar tu productividad y eficiencia</p>
    <?php if (!empty($tools)) { ?>
    <div class="positionTool">
        <?php foreach ($tools['ToolsCapture'] as $tool) { ?>
            <?php include __DIR__ . '/../../templates/tools.php'; ?>
        <?php } ?>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay herramientas registradas aún</p>
    <?php } ?>
</main>