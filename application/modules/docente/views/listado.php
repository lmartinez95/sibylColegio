<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Alumno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result) { ?>
                <tr>
                    <td><?php echo $result["almCodigo"]; ?></td>
                    <td><?php echo $result["Nombre"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>