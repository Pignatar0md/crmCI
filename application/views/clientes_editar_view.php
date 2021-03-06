<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="container-fluid">
    <?php
		echo form_open('clientes/save_form');
		$id = array("name" => "id");
    $nombre = array("name" => "nom", "class" => "form-control input-sm", "value" => $cliente[0]['nom'], "placeholder" => "Nombre Apellido");
    $direc = array("name" => "direc", "class" => "form-control input-sm", "value" => $cliente[0]['direc'], "placeholder" => "direccion");
    $localid = array("name" => "localid", "class" => "form-control input-sm", "value" => $cliente[0]['localid'], "placeholder" => "localidad");
    $codpostal = array("name" => "codpostal", "class" => "form-control input-sm", "value" => $cliente[0]['codpostal'], "placeholder" => "cod.postal");
    $prov = array("name" => "pcia", "class" => "form-control input-sm", "value" => $cliente[0]['pcia'], "placeholder" => "provincia");
    $tel1 = array("name" => "tel1", "class" => "form-control input-sm", "value" => $cliente[0]['tel1'], "placeholder" => "telefono");
    $tel2 = array("name" => "tel2", "class" => "form-control input-sm", "value" => $cliente[0]['tel2'], "placeholder" => "telefono alternativo");
    $email = array("name" => "email", "class" => "form-control input-sm", "value" => $cliente[0]['email'], "placeholder" => "direccion de e-mail");
		$tel3 = array("name" => "tel3", "class" => "form-control input-sm", "value" => $cliente[0]['tel3'], "placeholder" => "telefono móvil");
    $selPub = array("class" => "form-control");
		$region = array("class" => "form-control", "value" => $cliente[0]['selReg']);
    $selCombo = array("class" => "form-control", "value" => $cliente[0]['selCalif']);
    $agente = array("class" => "form-control input-sm", "readonly" => "true", "name" => "agcod", "value" => $cliente[0]['agcod']);
    $comentarios = array("name" => "obsC", "class" => "form-control input-sm", "cols" => "9", "rows" => "3", "value" => $cliente[0]['obsC']);
    $update = array("name" => "update", "class" => "btn btn-primary btn-sm", "type" => "submit", "value" => "Actualizar datos");

    ?>
        <div class="col-md-10 col-md-offset-1">
            <br>
            <legend>Datos Del Cliente</legend>
            <div class="row-fluid">
                <div class="form-group">
                    <div class="col-md-3">
                        <?= form_label('Nombre', 'nom') ?>
                        <?= form_input($nombre); ?>
												<?= form_hidden("id", $_GET['id']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                        <?= form_label('Domiclio', 'direc') ?>
                        <?= form_input($direc) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                        <?= form_label('Localidad', 'localid') ?>
                        <?= form_input($localid) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <?= form_label('Cód. postal', 'codpostal') ?>
                        <?= form_input($codpostal) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1">
                        <?= form_label('Agente', 'agcod') ?>
                        <?= form_input($agente) ?>
                    </div>
                </div>
            </div>
						<div class="row-fluid">
                <div class="form-group">
                    <div class="col-md-3"><br>
                        <?= form_label('Provincia', 'pcia') ?>
                        <?= form_input($prov) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3"><br>
                        <?= form_label('Teléfono', 'tel1') ?>
                        <?= form_input($tel1) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3"><br>
                        <?= form_label('Teléfono alternativo', 'tel2') ?>
                        <?= form_input($tel2) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3"><br>
                        <?= form_label('Teléfono móvil', 'tel3') ?>
                        <?= form_input($tel3) ?>
                    </div>
                </div>
            </div>
						<br>
            <div class="row-fluid">
                <div class="form-group">
                    <div class="col-md-3"><br>
                        <?= form_label('E-mail', 'email') ?>
                        <?= form_input($email) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2"><br>
                        <?= form_label('Región', 'selReg') ?>
                        <?=
                        form_dropdown(
                          "selReg",
                          array(
                            0 => "seleccionar",
                            1 => "CABA",
                            2 => "Norte",
                            3 => "Sur",
                            4 => "Oeste"
                          ),
                          $cliente[0]['selReg'],
                          $region
                        )
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"><br>
                        <?= form_label('Dónde vió la publicidad de Telecentro?', 'selPub') ?>
                        <?=
                        form_dropdown(
                          "selPub",
                           array(
                                0 => "seleccionar",
                                1 => "Lo vi en televisión",
                                2 => "Vi un cartel en la calle",
                                3 => "Vi un cartel en el subte",
                                4 => "Vi un cartel en una parada de colectivo",
                                5 => "Lo vi en una revista o diario",
                                6 => "Me llego un folleto a mi casa",
                                7 => "Vi una publicidad en Internet",
                                8 => "Entré a la página web",
                                9 => "Me lo recomendó un amigo o pariente"
                           ),
                           $cliente[0]['selPub'],
                           $selPub
                        )
                        ?>
                    </div>
                </div>
            </div>
				</div>
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12">
                <br>
            </div>
            <legend style="text-align: left">Comentarios</legend>
            <div class="form-group">
                <div class="col-md-6">
                  <?= form_label('Observación', 'obsC') ?>
                  <?= form_textarea($comentarios) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <?= form_label('Calificación', 'selCalif') ?>
                    <?=
                    form_dropdown(
                      "selCalif",
                      array(
                        0 => "seleccionar",
                        1 => "No Califico!",
                        2 => "Fuera de zona",
                        3 => "No venta",
                        4 => "UHF",
                        5 => "Venta"
                      ),
                      $cliente[0]['selCalif'],
                      $selCombo
                    )
                    ?>
                </div>
            </div>
            <div class="row-fluid">
                <br>
                <?= form_submit($update) ?>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <hr/>
            </div>
        </div>
    </form>
</div>
