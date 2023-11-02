<x-app-layout>
    <div class="p-4">
        {{-- header --}}
            <h2 class="mx-2 my-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">{{ __('admin.supporting_documents') }}</h2>
        {{-- end header --}}

        {{-- tab --}}
        
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#supportingDocumentTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="identity-card-tab" data-tabs-target="#identity-card" type="button" role="tab" aria-controls="identity-card" aria-selected="false">{{ __('admin.IC') }}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="others-tab" data-tabs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">{{ __('admin.other') }}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="profile-picture-tab" data-tabs-target="#profile-picture" type="button" role="tab" aria-controls="profilePicture" aria-selected="false">{{ __('admin.picture') }}</button>
                </li>
            </ul>
        </div>
        <div id="supportingDocumentTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="identity-card" role="tabpanel" aria-labelledby="identity-card-tab">
                @foreach($identity_document_list as $image)
                    @if( $image->getFoldername()=="icFront" )
                        <p class="underline-offset-1 text-gray-400 dark:text-white">{{ __('admin.IC_F') }}</p>
                    @elseif($image->getFoldername()=="icBack")
                    <br>
                        <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.IC_B') }}</p>
                    @endif
                    <br>
                    @if($image->getFileType()=='application/pdf')
                        <a href="{{ route('displaydocument.displaySingleIdentityDocument',['id'=> Crypt::encrypt($image->getSupportingdocumentid()),'maindirectory' => Crypt::encrypt($image->getFoldername())]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" target="_blank" >{{ __('admin.pdf') }}</a>
                    <br>
                    @else
                        <img src="{{ $image->getEncodedImage() }}" class="img-fluid" id="identityDocument<?php echo $image->getSupportingdocumentid() ?>" width="500px" height="500px" onclick="showDownloadOption(event)">
                    @endif
                @endforeach
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="others" role="tabpanel" aria-labelledby="others-tab">
                
                @foreach($document_list as $image)
                @if( $image->getFoldername()=="schoolLeavingCerts" )
                    <p class="underline-offset-1 text-gray-400 dark:text-white">{{ __('admin.graduate_certificate') }}</p>
                @elseif($image->getFoldername()=="secondarySchoolTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_secondary') }}</p>
                @elseif($image->getFoldername()=="upperSecondarySchoolTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_upper') }}</p>
                @elseif($image->getFoldername()=="foundationTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_foundation') }}</p>
                @elseif($image->getFoldername()=="diplomaTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_diploma') }}</p>
                @elseif($image->getFoldername()=="degreeTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_degree') }}</p>
                @elseif($image->getFoldername()=="masterTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_master') }}</p>
                @elseif($image->getFoldername()=="phdTranscripts")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_phd') }}</p>
                @elseif($image->getFoldername()=="others")
                <br>
                    <p class="text-gray-400 dark:text-white underline-offset-1">{{ __('admin.transcript_other') }}</p>
                @endif
                <br>
                    @if($image->getFileType()=='application/pdf')
                        <a href="{{ route('displaydocument.displaySingleDocument',['id'=> Crypt::encrypt($image->getSupportingdocumentid()),'maindirectory' => Crypt::encrypt($image->getFoldername())]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 my-4" target="_blank" >{{ __('button.pdf') }}</a>
                        <br>    
                    @else
                        <img src="{{ $image->getEncodedImage() }}" id="supportingDocument<?php echo $image->getSupportingdocumentid()?>" class="my-4" width="500px" height="500px" onclick="showDownloadOption(event)">
                    @endif
                @endforeach
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile-picture" role="tabpanel" aria-labelledby="profile-picture-tab">
                <img class="img-fluid" id="profilePicture<?php echo $data['application_profile_id']?>" src="{{ $data['profile_image'] }}" alt="Profile Picture" onclick="showDownloadOption(event)">
            </div>
        </div>
        {{-- end tab --}}
    </div>

    <script>
        // Onclick show download option
        function showDownloadOption(event) {
            // Get the ID of the image element that was clicked
            const imageId = event.target.id;
    
            // Get the file name from the data URL
            const fileName = imageId + "." + event.target.src.split(";")[0].split("/")[1];
    
            // Create a new anchor element
            const link = document.createElement("a");
    
            // Set the href attribute to the data URL
            link.href = event.target.src;
    
            // Set the download attribute to the file name
            link.download = fileName;
    
            // Append the anchor element to the document body
            document.body.appendChild(link);
    
            // Click the anchor element to trigger the download
            link.click();
    
            // Remove the anchor element from the document body
            document.body.removeChild(link);
        }
    </script>
</x-app-layout>