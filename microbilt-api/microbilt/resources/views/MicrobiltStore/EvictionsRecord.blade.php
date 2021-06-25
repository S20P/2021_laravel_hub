
                                    <table class="table table-bordered mb-5">
                                        <thead>
                                            <tr class="table-success">
                                                <th scope="col">#</th>
                                                <th scope="col">Report</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($EvictionsData->count() == 0)
                                            <tr>
                                                <td colspan="5">No records to display.</td>
                                            </tr>
                                            @endif
                                            @foreach($EvictionsData as $data)
                                            <tr>
                                                <th scope="row">{{ $data->RqUID }}</th>
                                                <td>
                                                 <button class="btn btn-primary GetArchiveReport" data-Report="Evictions" data-AppId="{{$data->response['MsgRsHdr']['RqUID'] ?? ''}}">GetArchiveReport</button> 
                                                    <p class="msg"></p> 
                                                    <div class="ArchiveReportPrview">
                                                         <h1>Archive Report Preview</h1>
                                                   
                                                    @php
                                                    $response = $data->response;
                                                    @endphp

                                                    @if(isset($response['Subject']))
                                                    @php
                                                    $subject = $data->response['Subject'];
                                                    @endphp
                                                    @foreach($subject as $subjectData)


                                                   <P> <b>RecordID</b>: {{ $subjectData['RecordID'] ?? '' }}<br /> </P> 
                                                   <P> <b>EvictionsInd</b>: {{ $subjectData['EvictionsInd'] ?? '' }}<br /> </P> 

                                                    <table id="products-table" class="table table-bordered table-hover" class="display"
                                                        style="width:100%">
                                                        <thead>
                                                            <th>FileDate</th>
                                                            <th>CourtName</th>
                                                            <th>CountyCode</th>
                                                            <th>FilingState</th>
                                                            <th>AssetAmt</th>
                                                            <th>LiabilityAmt</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$subjectData['EvictionsCase']['FileDt'] ?? '' }}</td>
                                                            <td>{{$subjectData['EvictionsCase']['CourtName'] ?? '' }}</td>
                                                            <td>{{$subjectData['EvictionsCase']['CountyCode'] ?? '' }}</td>
                                                            <td>{{$subjectData['EvictionsCase']['FilingState'] ?? '' }}</td>
                                                            <td>{{$subjectData['EvictionsCase']['AssetAmt']['Amt'] ?? '' }} {{$subjectData['EvictionsCase']['AssetAmt']['CurCode'] ?? '' }} </td>
                                                            <td>{{$subjectData['EvictionsCase']['LiabilityAmt']['Amt'] ?? '' }} {{$subjectData['EvictionsCase']['LiabilityAmt']['CurCode'] ?? '' }} </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- Parties -->
                                                    @if(isset($subjectData['Parties']))
                                                    <h3>Parties</h3>
                                                    <table id="products-table" class="table table-bordered table-hover" class="display"
                                                        style="width:100%">
                                                        <thead>
                                                            <th>PartyType</th>
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
                                                                    {{ $Parties['PartyType'] ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if(isset($Parties['PersonInfo']) && count($Parties['PersonInfo'])>0)
                                                                    @foreach ($Parties['PersonInfo'] as $PersonInfo)
                                                                    @foreach ($PersonInfo['PersonName'] as $key=>$value)
                                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                                    @endforeach
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

                                                    <!-- FilingsInfo -->

                                                    @if(isset($subjectData['FilingsInfo']))

                                                    <h3>FilingsInfo</h3>

                                                    <table class="table table-bordered mb-5">
                                                        <thead>
                                                            <tr class="table-success">
                                                                <th scope="col">FilingType</th>
                                                                <th scope="col">FilingDate</th>
                                                                <th scope="col">ActionCode</th>
                                                                <th scope="col">Source</th>
                                                                <th scope="col">EffDate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($subjectData['FilingsInfo'] as $FilingsInfo)
                                                            <tr>
                                                                <th scope="row">{{ $FilingsInfo['FilingType'] ?? '' }}</th>
                                                                <td>{{ $FilingsInfo['FilingDt'] ?? '' }}</td>
                                                                <td>
                                                                @foreach($FilingsInfo['ActionCode'] as $key=>$value)
                                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                                @endforeach
                                                                </td>
                                                                <td>{{ $FilingsInfo['Source'] ?? '' }}</td>
                                                                <td>{{ $FilingsInfo['EffDt'] ?? '' }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                    <!-- FilingsInfo -->

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
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center">
                                        {!! $EvictionsData->links() !!}
                                    </div>

