<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($this->session->userdata['logged_in']))
{
    header("location: login/user_login_process");
}
$header;
?>
				<div class="container'fluid">
					  <!-- Modal -->
					  <div class="modal fade" id="myModal2" role="dialog">
						    <div class="modal-dialog modal-lg">
							      <div class="modal-content">
								        <div class="modal-header">
								          	<button type="button" class="close" data-dismiss="modal">&times;</button>
								          	<h4 class="modal-title">Detalle de cliente</h4>
								        </div>
								        <div class="modal-body">

													<table id="listaDetalleClientes" class="table table-compressed table-stripped">
															<thead class = "tbl-header">
																	<tr>
																		  <th>Nombre</th>
																			<th>Teléfono alternativo</th>
																			<th>Teléfono móvil</th>
																			<th>Cód. postal</th>
																			<th>Fecha de registro</th>
																			<th>Observaciones</th>
																			<th>Contacto con telecentro</th>
																			<th>Región</th>
																			<th>Agente</th>
																	</tr>
															</thead>
															<tbody>
															</tbody>
													</table>

								        </div>
								        <div class="modal-footer">
								          	<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cerrar</button>
								        </div>
							      </div>
						    </div>
					  </div>
					 <!-- end Modal -->
					  <br>
					  <div class="row-fluid">
							  <div class="col-md-10 col-md-offset-1">
							      <legend>Búsqueda de clientes</legend>
								</div>
						</div>
						<div class="row-fluid">
							  <?= form_open('clientes/get_csv') ?>
                <div class="col-md-10 col-md-offset-1">
										<div class="col-md-3">
									      <input type="text" class="form-control" id="agente" name="agente" placeholder="nro. agente"/>
										</div>
										<div class="col-md-3">
											  <input type="text" class="form-control" id="tel1" name="tel1" placeholder="telefono"/>
										</div>
										<div class="col-md-3">
											  <input type="text" id="rango_fecha" class="form-control" name="rango_fecha" placeholder="rango fecha de alta" />
										</div>
										<div class="col-md-3">
										    <button type="button" class="btn btn-sm btn-warning" id="btnSearch">Buscar</button>
										    <input type="submit" class="btn btn-sm btn-warning" value="Descargar .csv" id="btnGetCsv" />
										</div>
                </div>
							  </form>
						</div>
					  <div class="row-fluid">

								<div class="col-md-10 col-md-offset-1">
									<br>
										<table id="listaClientes" class="table table-compressed table-stripped">
												<thead  class = "tbl-header">
														<tr>
																<th>Nombre y apellido</th>
																<th>Domicilio</th>
																<th>Localidad</th>
																<th>Provincia</th>
																<th>Teléfono</th>
																<th>E-mail</th>
																<th>Calificación</th>
																<th>Acciones</th>
														</tr>
												</thead>
												<tbody>
													  <?php foreach ($lista_clientes as $cliente): ?>
														<tr>
																<td><?= $cliente['nom'] ?></td>
																<td><?= $cliente['direc'] ?></td>
																<td><?= $cliente['localid'] ?></td>
																<td><?= $cliente['pcia'] ?></td>
																<td><?= $cliente['tel1'] ?></td>
																<td><?= $cliente['email'] ?></td>
																<td>
																	  <?php
																	  switch ($cliente['selCalif']) {
																		    case 1:
																			      echo "No califico!";
																			      break;

																				case 2:
																					  echo "Fuera de zona";
																					  break;

																				case 3:
																				    echo "No venta";
																				    break;

																				case 4:
																				    echo "UHF";
																				    break;

																				case 5:
																					  echo "Venta";
																					  break;
																	  }
																	  ?>
																</td>
																<td>
																	  <button type="button" class="btn btn-sm btn-primary ver" data-toggle="modal" data-target="#myModal2" value="<?= $cliente['id'] ?>">+ info</button>
																	  <a type="button" class="btn btn-sm btn-primary" href="editar_cliente?id=<?= $cliente['id'] ?>">Editar</button></a>
																</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
										</table>
							  </div>
					  </div>
				</div>
<?php $footer ?>
