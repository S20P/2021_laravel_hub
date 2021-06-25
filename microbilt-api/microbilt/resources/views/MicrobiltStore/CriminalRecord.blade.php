
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Report</th>
            </tr>
        </thead>
        <tbody>
            @if ($CriminalData->count() == 0)
            <tr>
                <td colspan="5">No records to display.</td>
            </tr>
            @endif
            @foreach($CriminalData as $data)
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

                    <table id="products-table" class="table table-bordered table-hover" class="display"
                        style="width:100%">
                        <thead>
                            <th>DataSource</th>
                            <th>RecordID</th>
                            <th>RecordType</th>
                            <th >PersonInfo</th>
                            <th>CriminalInfo</th>
                        </thead>
                        <tbody>
                            @foreach($subject as $subjectData)

                            <tr>
                                <td>
                                    {{ $subjectData['DataSource'] ?? '' }}
                                </td>
                                <td>
                                    {{ $subjectData['RecordID'] ?? '' }}
                                </td>
                                <td>
                                    {{ $subjectData['RecordType'] ?? '' }}
                                </td>
                                <td>
                                    @if(isset($subjectData['PersonInfo']) && count($subjectData['PersonInfo'])>0)
                                    <h4>PersonName</h4>
                                    @if(isset($subjectData['PersonInfo']['PersonName']['FirstName']))
                                    <p> <b>FirstName</b>:    {{ $subjectData['PersonInfo']['PersonName']['FirstName'] ?? '' }} </p>
                                    @endif

                                    @if(isset($subjectData['PersonInfo']['PersonName']['LastName']))
                                    <p> <b>LastName</b>:    {{ $subjectData['PersonInfo']['PersonName']['LastName'] ?? '' }} </p>
                                    @endif

                                    @if(isset($subjectData['PersonInfo']['PersonName']['MiddleName']))
                                    <p> <b>MiddleName</b>:    {{ $subjectData['PersonInfo']['PersonName']['MiddleName'] ?? '' }} </p>
                                    @endif
                                   
                                   <h4>ContactInfo</h4>
                                    @if(isset($subjectData['PersonInfo']['ContactInfo']) && count($subjectData['PersonInfo']['ContactInfo'])>0)
                                    @foreach ($subjectData['PersonInfo']['ContactInfo'] as $ContactInfo)
                                    @foreach ($ContactInfo['PostAddr'] as $key=>$value)
                                   <p> <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }} </p>
                                    @endforeach
                                    @endforeach
                                    @endif
                                    @if(isset($subjectData['PersonInfo']['BirthDt']))
                                    <p> <b>Birth Date</b>:    {{ $subjectData['PersonInfo']['BirthDt'] ?? '' }} </p>
                                    @endif
                                    @if(isset($subjectData['PersonInfo']['PhysicalCharacteristics']))
                                    <h4>PhysicalCharacteristics</h4>
                                     @foreach ($subjectData['PersonInfo']['PhysicalCharacteristics'] as $key=>$value)
                                      <p>  <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}</p>
                                     @endforeach
                                    @endif
                                    @if(isset($subjectData['PersonInfo']['MilitaryIdInfo']['MilitaryIdNum']))
                                    <p> <b>MilitaryIdNum</b>:    {{ $subjectData['PersonInfo']['MilitaryIdInfo']['MilitaryIdNum'] ?? '' }} </p>
                                    @endif
                                
                                    @endif
                                   </td>
                                <td>
                                    @if(isset($subjectData['CriminalCase']))

                                     @php

                                     $CriminalCase = $subjectData['CriminalCase'];

                                     @endphp 

                                     <table id="products-table" class="table table-bordered table-hover" class="display"
                                        style="width:100%">
                                        <thead>
                                            <th>CaseId</th>
                                            <th>ArrestingAgency</th>
                                            <th>CourtName</th>
                                            <th>CourtJurisdiction</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $CriminalCase['CaseId'] ?? '' }}</td>
                                                <td>
                                                    @if(isset($CriminalCase['ArrestingAgency']) && count($CriminalCase['ArrestingAgency'])>0)
                                                    @foreach ($CriminalCase['ArrestingAgency'] as $key=>$value)
                                                    <b>{{ $key ?? '' }}</b>: {{ $value ?? '' }}<br />
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $CriminalCase['CourtName'] ?? '' }}</td>
                                                <td>{{ $CriminalCase['CourtJurisdiction'] ?? '' }}</td>
                                             </tr>
                                         </tbody>
                                     </table>

                                     @if(isset($CriminalCase['Charge']) && count($CriminalCase['Charge'])>0)
                                     <h4>Charge Info</h4>
                                                   <table id="products-table" class="table table-bordered table-hover"
                                                        class="display" style="width:100%">
                                                        <thead>
                                                            <th>ChargeDt</th>
                                                            <th>OffenseDt</th>
                                                            <th>DispositionDt</th>
                                                            <th>OriginationState</th>
                                                            <th>OffenseDesc</th>
                                                            <th>Statute</th>
                                                            <th>OriginationName</th>
                                                            <th>CaseType</th>
                                                            <th>Source</th>
                                                            <th>EffDt</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($CriminalCase['Charge'] as $Charge)
                                                                </tr>
                                                                <td>{{ $Charge['ChargeDt'] ?? '' }}</td>
                                                                <td>{{ $Charge['OffenseDt'] ?? '' }}</td>
                                                                <td>{{ $Charge['DispositionDt'] ?? '' }}</td>
                                                                <td>{{ $Charge['OriginationState'] ?? '' }}</td>
                                                                <td>{{ $Charge['OffenseDesc'] ?? '' }}</td>
                                                                <td>{{ $Charge['Statute'] ?? '' }}</td>
                                                                <td>{{ $Charge['OriginationName'] ?? '' }}</td>
                                                                <td>{{ $Charge['CaseType'] ?? '' }}</td>
                                                                <td>{{ $Charge['Source'] ?? '' }}</td>
                                                                <td>{{ $Charge['EffDt'] ?? '' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                            @endif
                                        </td>
  
    </tr>
    @endforeach
    </tbody>
    </table>
    @endif
    </div>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $CriminalData->links() !!}
    </div>
