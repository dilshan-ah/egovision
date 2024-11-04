@extends('layouts.app')
@section('content')
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$myTicket = TranslationHelper::translateText('My Support Ticket', $preferredLanguage);
$openTicket = TranslationHelper::translateText('Open Ticket', $preferredLanguage);

$name = TranslationHelper::translateText('Name', $preferredLanguage);
$email = TranslationHelper::translateText('Email Address', $preferredLanguage);
$subject = TranslationHelper::translateText('Subject', $preferredLanguage);
$priority = TranslationHelper::translateText('Priority', $preferredLanguage);
$message = TranslationHelper::translateText('Message', $preferredLanguage);
$action = TranslationHelper::translateText('Action', $preferredLanguage);

$open = TranslationHelper::translateText('Open', $preferredLanguage);
$answered = TranslationHelper::translateText('Answered', $preferredLanguage);
$replied = TranslationHelper::translateText('Replied', $preferredLanguage);
$closed = TranslationHelper::translateText('Closed', $preferredLanguage);

$low = TranslationHelper::translateText('Low', $preferredLanguage);
$medium = TranslationHelper::translateText('Medium', $preferredLanguage);
$high = TranslationHelper::translateText('High', $preferredLanguage);

$addNew = TranslationHelper::translateText('Add New', $preferredLanguage);
$attach = TranslationHelper::translateText('Attachments', $preferredLanguage);
$max = TranslationHelper::translateText('Max 5 files can be uploaded Maximum upload size is', $preferredLanguage);
$max = TranslationHelper::translateText('Max 5 files can be uploaded Maximum upload size is', $preferredLanguage);
$allowed = TranslationHelper::translateText('Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx', $preferredLanguage);
$submitBtn = TranslationHelper::translateText('Submit', $preferredLanguage);
@endphp
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="text-end">
                <a href="{{route('ticket.index') }}" class="btn btn-dark mb-2">{{$myTicket}}</a>
            </div>
            <div class="card bg-light">
                <div class="card-header bg-dark">
                    <h5 class="text-white">{{$openTicket}}</h5>
                </div>

                <div class="card-body">
                    <form action="{{route('ticket.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{$name}}</label>
                                <input type="text" style="padding: 12px 20px;" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control d-flex w-100 my-0" required readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">{{$email}}</label>
                                <input type="email" style="padding: 12px 20px;" name="email" value="{{@$user->email}}" class="form-control d-flex w-100 my-0" required readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">{{$subject}}</label>
                                <input type="text" style="padding: 12px 20px;" name="subject" value="{{old('subject')}}" class="form-control d-flex w-100 my-0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">{{$priority}}</label>
                                <select name="priority" style="padding: 12px 20px;" class="form-control d-flex w-100 my-0" required>
                                    <option value="3">{{$high}}</option>
                                    <option value="2">{{$medium}}</option>
                                    <option value="1">{{$low}}</option>
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label">{{$message}}</label>
                                <textarea name="message" id="inputMessage" rows="6" class="form-control " required>{{old('message')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-end">
                                <button type="button" id="addFile" onclick="faltu()" class="btn btn-dark btn-sm addFile">
                                    <i class="fa fa-plus"></i> {{$addNew}}
                                </button>
                            </div>
                            <div class="file-upload">
                                <label class="form-label">{{$attach}}</label> <small class="text-danger">{{ $max }} {{ ini_get('upload_max_filesize') }}</small>
                                <input type="file" name="attachments[]" id="inputAttachments" class="form-control form--control mb-2" />
                                <div id="fileUploadsContainer"></div>
                                <p class="ticket-attachments-message text-muted">
                                    {{$allowed}}
                                </p>
                            </div>

                        </div>

                        <div class="form-group">
                            <button class="btn btn-dark w-100" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        "use strict";
        var fileAdded = 0;
        $('.addFile').on('click', function() {
            if (fileAdded >= 4) {
                notify('error', 'You\'ve added the maximum number of files');
                return false;
            }
            fileAdded++;
            $("#fileUploadsContainer").append(`
                <div class="input-group my-3">
                    <input type="file" name="attachments[]" class="form-control" required />
                    <button type="button" class="input-group-text btn-danger remove-btn"><i class="fas fa-times"></i></button>
                </div>
            `);
        });

        $(document).on('click', '.remove-btn', function() {
            fileAdded--;
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endsection

@push('style')
<style>
    .input-group-text:focus {
        box-shadow: none !important;
    }
</style>
@endpush