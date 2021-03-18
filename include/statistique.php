<!--custom-widgets-->
												<div class="custom-widgets">
												   <div class="row-one">
														<div class="col-md-3 widget">
															<div class="stats-left ">
																<h5>Professeur</h5>
																<h4> Professeur</h4>
															</div>
															<div class="stats-right">
																<label><?php echo state('professeurs','idprofesseurs',$mysqli); ?></label>
															</div>
															<div class="clearfix"> </div>	
														</div>
														<div class="col-md-3 widget states-mdl">
															<div class="stats-left">
																<h5>Filières</h5>
																<h4>Filières</h4>
															</div>
															<div class="stats-right">
																<label><?php echo state('filiere','idfiliere',$mysqli); ?></label>
															</div>
															<div class="clearfix"> </div>	
														</div>
														<div class="col-md-3 widget states-thrd">
															<div class="stats-left">
																<h5>Matières</h5>
																<h4>Matières</h4>
															</div>
															<div class="stats-right">
																<label><?php echo state('matieres','idmatieres',$mysqli); ?></label>
															</div>
															<div class="clearfix"> </div>	
														</div>
														<div class="col-md-3 widget states-last">
															<div class="stats-left">
																<h5>Emargements</h5>
																<h4>du Mois</h4>
															</div>
															<div class="stats-right">
																<label><?php echo stateDeux('emargement','date_emar',$month,$idann_sco,$idmodule,$mysqli); ?></label>
															</div>
															<div class="clearfix"> </div>	
														</div>
														<div class="clearfix"> </div>	
													</div>
												</div>
												<!--//custom-widgets-->









