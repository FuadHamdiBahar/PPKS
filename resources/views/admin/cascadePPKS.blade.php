@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Most Commonly Asked Questions</h4>
                    <p class="text-muted mb-0">Anim pariatur cliche reprehenderit,
                        enim eiusmod high life accusamus terry richardson ad squid.
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="accordion" id="accordionExample-faq">

                        <div class="card shadow-none border mb-1">
                            <div class="card-header" id="headingTwo">
                                <h5 class="my-0">
                                    <button class="btn btn-link collapsed ml-4 align-self-center shadow-none" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        How buy Dastyle on coin?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample-faq">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                    squid single-origin coffee nulla assumenda shoreditch et.
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-none border mb-1">
                            <div class="card-header" id="headingThree">
                                <h5 class="my-0">
                                    <button class="btn btn-link collapsed ml-4 shadow-none" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        What cryptocurrency can i use to buy Dastyle?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample-faq">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end accordion-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <!--end row-->
@endsection
