
                                    <table class="table table-bordered mb-5">
                                        <thead>
                                            <tr class="table-success">
                                                <th scope="col">#</th>
                                                <th scope="col">Report</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($BankruptcyData->count() == 0)
                                            <tr>
                                                <td colspan="5">No records to display.</td>
                                            </tr>
                                            @endif
                                            @foreach($BankruptcyData as $data)
                                            <tr>
                                                <th scope="row">{{ $data->RqUID }}</th>
                                                <td>
                                                    {{$data->response['MsgRsHdr']['RqUID'] ?? ''}}

                                                    @php
                                                    $response = $data->response;
                                                    @endphp

                                                    @if(isset($response['Subject']))
                                                    @php
                                                    $subject = $data->response['Subject'];
                                                    @endphp
                                                    @foreach($subject as $subjectData)

                                                    <!-- Parties -->

                                                    @if(isset($subjectData['Parties']))
                                                    <h3>Parties</h3>
                                                    <table id="products-table" class="table table-bordered table-hover" class="display"
                                                        style="width:100%">
                                                        <thead>
                                                            <th>RecordID</th>
                                                            <th>PartyType</th>
                                                            <th>OrgInfo</th>
                                                            <th>PersonInfo</th>
                                                            <th>ContactInfo</th>
                                                            <th>Source</th>
                                                            <th>EffDate</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($subjectData['Parties'] as $Parties)
                                                            @if(isset($Parties) && count($Parties)>0)

                                                            <tr>
                                                                <td>
                                                                    {{ $Parties['RecordID'] ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $Parties['PartyType'] ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if(isset($Parties['OrgInfo']) && count($Parties['OrgInfo'])>0)
                                                                    @foreach ($Parties['OrgInfo'] as $OrgInfo)
                                                                     <P> <b>Name</b>: {{$OrgInfo['Name'] ?? '' }}</P>
                                                                     @foreach ($OrgInfo['ContactInfo'] as $ContactInfo)
                                                                     <P> <b>PhoneType</b>: {{$ContactInfo['PhoneNum']['PhoneType'] ?? '' }}</P>
                                                                     <P> <b>Phone</b>: {{$ContactInfo['PhoneNum']['Phone'] ?? '' }}</P>
                                                                     @endforeach

                                                                     <P> <b>EmailAddr</b>: {{$ContactInfo['EmailAddr'] ?? '' }}</P>
                                                                     @foreach ($ContactInfo['PostAddr'] as $key=>$value)
                                                                     <P><b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}</P>
                                                                    @endforeach


                                                                    @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(isset($Parties['PersonInfo']) && count($Parties['PersonInfo'])>0)
                                                                    @foreach ($Parties['PersonInfo'] as $PersonInfo)
                                                                    @foreach ($PersonInfo['PersonName'] as $key=>$value)
                                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                                    @endforeach
                                                                    @if(isset($PersonInfo['TINInfo']))
                                                                    @foreach ($PersonInfo['TINInfo'] as $key=>$value)
                                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                                    @endforeach
                                                                    @endif

                                                                    @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(isset($Parties['PersonInfo']) && count($Parties['PersonInfo'])>0)
                                                                    @foreach ($Parties['PersonInfo'] as $PersonInfo)
                                                                    @if(isset($PersonInfo['ContactInfo']) && count($PersonInfo['ContactInfo'])>0)
                                                                    @foreach ($PersonInfo['ContactInfo'] as $ContactInfo)
                                                                    @foreach ($ContactInfo['PostAddr'] as $key=>$value)
                                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                                    @endforeach
                                                                    @endforeach
                                                                    @endif
                                                                    @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $Parties['Source'] ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $Parties['EffDt'] ?? '' }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                    <!-- Parties -->

                                                    <!-- PublicRecord -->

                                                    @if(isset($subjectData['PublicRecord']))

                                                    <h3>PublicRecord</h3>

                                                    <table class="table table-bordered mb-5">
                                                        <thead>
                                                            <tr class="table-success">
                                                                <th scope="col">CaseId</th>
                                                                <th scope="col">PRType</th>
                                                                <th scope="col">AttorneyName</th>
                                                                <th scope="col">Amt</th>
                                                                <th scope="col">CurCode</th>
                                                                <th scope="col">CourtName</th>
                                                                <th scope="col">FilingDt</th>
                                                                <th scope="col">DefendantName</th>
                                                                <th scope="col">Plaintiff</th>
                                                                <th scope="col">JudgeTrustee</th>
                                                                <th scope="col">DismissedDt</th>
                                                                <th scope="col">CourtInfo</th>
                                                                <th scope="col">ClosedDt</th>
                                                                <th scope="col">ReOpenedDt</th>
                                                                <th scope="col">ConvertedDt</th>
                                                                <th scope="col">TransferredDt</th>
                                                                <th scope="col">WithdrawnDt</th>
                                                                <th scope="col">ClaimDt</th>
                                                                <th scope="col">ObjectionDt</th>
                                                                <th scope="col">OrigCase</th>
                                                                <th scope="col">OrigBook</th>
                                                                <th scope="col">OrigPage</th>
                                                                <th scope="col">Sch341DtTime</th>
                                                                <th scope="col">OriginalAmt</th>
                                                                <th scope="col">ReleaseDt</th>
                                                                <th scope="col">AssetsAvailForUnsecuredInd</th>
                                                           </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($subjectData['PublicRecord'] as $PublicRecord)
                                                            <tr>
                                                                <th scope="row">{{ $PublicRecord['CaseId'] ?? '' }}</th>
                                                                <td>{{ $PublicRecord['PRType'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['AttorneyName'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['BankruptcyAssetsAmt']['Amt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['BankruptcyAssetsAmt']['CurCode'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['CourtName'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['FilingDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['DefendantName'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['Plaintiff'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['JudgeTrustee'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['DismissedDt'] ?? '' }}</td>
                                                                <td>
                                                                @foreach ($PublicRecord['CourtInfo'] as $CourtInfo)
                                                                    <p><b>CourtState</b>: {{ $CourtInfo['CourtState'] ?? '' }} </p>
                                                                    <p><b>BookPage</b>: {{ $CourtInfo['BookPage'] ?? '' }} </p>
                                                                    <p><b>CourtJurisdiction</b>: {{ $CourtInfo['CourtJurisdiction'] ?? '' }} </p>
                                                                    <p><b>CourtName</b>: {{ $CourtInfo['CourtName'] ?? '' }} </p>
                                                                    <p><b>CourtCaseId</b>: {{ $CourtInfo['CourtCaseId'] ?? '' }} </p>
                                                                @endforeach
                                                                   
                                                                </td>
                                                                <td>{{ $PublicRecord['ClosedDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['ReOpenedDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['ConvertedDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['TransferredDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['WithdrawnDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['ClaimDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['ObjectionDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['OrigCase'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['OrigBook'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['OrigPage'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['Sch341DtTime'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['OriginalAmt']['Amt'] ?? '' }}  {{$PublicRecord['OriginalAmt']['CurCode']}}</td>
                                                                <td>{{ $PublicRecord['ReleaseDt'] ?? '' }}</td>
                                                                <td>{{ $PublicRecord['AssetsAvailForUnsecuredInd'] ?? '' }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                    <!-- PublicRecord -->

                                                    <!-- Message -->

                                                    @if(isset($subjectData['Message']))

                                                    <h3>Message</h3>

                                                    <table class="table table-bordered mb-5">
                                                        <thead>
                                                            <tr class="table-success">
                                                                <th scope="col">MsgClass</th>
                                                                <th scope="col">MsgCode</th>
                                                                <th scope="col">Text</th>
                                                                <th scope="col">Source</th>
                                                                <th scope="col">EffDate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($subjectData['Message'] as $Message)
                                                            <tr>
                                                                <th scope="row">{{ $Message['MsgClass'] ?? '' }}</th>
                                                                <td>{{ $Message['MsgCode'] ?? '' }}</td>
                                                                <td>{{ $Message['Text'] ?? '' }}</td>
                                                                <td>{{ $Message['Source'] ?? '' }}</td>
                                                                <td>{{ $Message['EffDt'] ?? '' }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                    <!-- Message -->

                                                    @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center">
                                        {!! $BankruptcyData->links() !!}
                                    </div>
                        