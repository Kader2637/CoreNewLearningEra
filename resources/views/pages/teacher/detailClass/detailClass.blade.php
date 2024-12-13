@extends('layouts.teacher.app')
@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo"></div>
                                </div>
                                <div class="profile-info">
									<div class="profile-photo">
										<img src="{{ asset('assetsTeacher/images/profile/4.jpg') }}" class="img-fluid rounded-circle" alt="">
									</div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
											<h4 class="text-primary mb-0">Mitchell C. Shay</h4>
											<p>UX / UI Designer</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0">info@example.com</h4>
											<p>Email</p>
										</div>
										<div class="dropdown ms-auto">
											<a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
												<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to close friends</li>
												<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
												<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-statistics mb-5">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="m-b-0">150</h3><span>Total materi</span>
                                            </div>
                                        </div>
                                        <div class="mt-4">
											<a href="javascript:void(0);" class="btn btn-primary mb-1 me-1">Follow</a>
											<a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Send Message</a>
                                        </div>
                                    </div>
									<div class="modal fade" id="sendMessageModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Send Message</h5>
													<button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
												</div>
												<div class="modal-body">
													<form class="comment-form">
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="text-black font-w600">Name <span class="required">*</span></label>
																	<input type="text" class="form-control" value="author" name="author" placeholder="author">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="text-black font-w600">Email <span class="required">*</span></label>
																	<input type="text" class="form-control" value="Email" placeholder="Email" name="Email">
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<label class="text-black font-w600">Comment</label>
																	<textarea rows="8" class="form-control" name="comment" placeholder="Comment"></textarea>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<input type="submit" value="Post Comment" class="submit btn btn-primary" name="submit">
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
                                </div>
                                <div class="profile-blog mb-5">
                                    <img src="images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100 b-radius">
                                    <h4><a href="javascrip:void(0)" class="text-black">Deskripsi</a></h4>
                                    <p class="mb-0">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                </div>
                                <div class="profile-news">
                                    <h5 class="text-primary d-inline">Materi tepopuler</h5>
                                    <div class="media pt-3 pb-3">
                                        <img src="{{ asset('assetsTeacher/images/profile/5.jpg') }}" alt="image" class="me-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="javascrip:void(0)" class="text-black">Collection of textile samples</a></h5>
                                            <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img src="{{ asset('assetsTeacher/images/profile/6.jpg') }}" alt="image" class="me-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="javascrip:void(0)" class="text-black">Collection of textile samples</a></h5>
                                            <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img  alt="image" class="me-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="javascrip:void(0)" class="text-black">Collection of textile samples</a></h5>
                                            <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show" aria-selected="true" role="tab">Materi</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade active show" role="tabpanel">
                                                <div class="my-post-content pt-3">

                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <img src="{{ asset('assetsTeacher/images/profile/1.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="javascrip:void(0)">
															<h3 class="text-black">Collection of textile samples lay spread</h3>
														</a>
                                                        <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                            of spare which enjoy whole heart.</p>
                                                        <button class="btn btn-primary me-2"><span class="me-2"><i class="fa fa-heart"></i></span>Suka</button>
                                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#replyModal"><span class="me-2"><i class="fa fa-reply"></i></span>Belajar</button>
                                                    </div>
                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <img src="{{ asset('assetsTeacher/images/profile/1.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="javascrip:void(0)">
															<h3 class="text-black">Collection of textile samples lay spread</h3>
														</a>
                                                        <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                            of spare which enjoy whole heart.</p>
                                                        <button class="btn btn-primary me-2"><span class="me-2"><i class="fa fa-heart"></i></span>Suka</button>
                                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#replyModal"><span class="me-2"><i class="fa fa-reply"></i></span>Belajar</button>
                                                    </div>
                                                    <div class="profile-uoloaded-post pb-3">
                                                        <img src="{{ asset('assetsTeacher/images/profile/1.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="javascrip:void(0)">
															<h3 class="text-black">Collection of textile samples lay spread</h3>
														</a>
                                                        <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                            of spare which enjoy whole heart.</p>
                                                        <button class="btn btn-primary me-2"><span class="me-2"><i class="fa fa-heart"></i></span>Suka</button>
                                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#replyModal"><span class="me-2"><i class="fa fa-reply"></i></span>Belajar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="about-me" class="tab-pane fade" role="tabpanel">
                                                <div class="profile-about-me">
                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                        <h4 class="text-primary">About Me</h4>
                                                        <p class="mb-2">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                                                        <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
