@extends('adminlte::page')

@section('title', __('eapplies.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('eapplies.header') }}</h1>
@stop

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/5.0.4/css/fixedColumns.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/3.0.0/css/select.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
<script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/3.0.0/js/select.dataTables.js"></script>
<script type="text/javascript" class="init">
	dt_demo.init({
		libs: {"targetFramework":"","js":["jquery","datatables","fixedcolumns","select"],"css":["datatables","fixedcolumns","select"],"components":{"datatables":{"css":"https:\/\/cdn.datatables.net\/2.2.2\/css","js":"https:\/\/cdn.datatables.net\/2.2.2\/js","resolve":true},"autofill":{"css":"https:\/\/cdn.datatables.net\/autofill\/2.7.0\/css","js":"https:\/\/cdn.datatables.net\/autofill\/2.7.0\/js","resolve":true},"buttons":{"css":"https:\/\/cdn.datatables.net\/buttons\/3.2.2\/css","js":"https:\/\/cdn.datatables.net\/buttons\/3.2.2\/js","resolve":true},"colreorder":{"css":"https:\/\/cdn.datatables.net\/colreorder\/2.0.4\/css","js":"https:\/\/cdn.datatables.net\/colreorder\/2.0.4\/js","resolve":true},"editor":{"css":"..\/..\/css","js":"..\/..\/js","resolve":true},"fixedcolumns":{"css":"https:\/\/cdn.datatables.net\/fixedcolumns\/5.0.4\/css","js":"https:\/\/cdn.datatables.net\/fixedcolumns\/5.0.4\/js","resolve":true},"fixedheader":{"css":"https:\/\/cdn.datatables.net\/fixedheader\/4.0.1\/css","js":"https:\/\/cdn.datatables.net\/fixedheader\/4.0.1\/js","resolve":true},"keytable":{"css":"https:\/\/cdn.datatables.net\/keytable\/2.12.1\/css","js":"https:\/\/cdn.datatables.net\/keytable\/2.12.1\/js","resolve":true},"responsive":{"css":"https:\/\/cdn.datatables.net\/responsive\/3.0.4\/css","js":"https:\/\/cdn.datatables.net\/responsive\/3.0.4\/js","resolve":true},"rowgroup":{"css":"https:\/\/cdn.datatables.net\/rowgroup\/1.5.1\/css","js":"https:\/\/cdn.datatables.net\/rowgroup\/1.5.1\/js","resolve":true},"rowreorder":{"css":"https:\/\/cdn.datatables.net\/rowreorder\/1.5.0\/css","js":"https:\/\/cdn.datatables.net\/rowreorder\/1.5.0\/js","resolve":true},"scroller":{"css":"https:\/\/cdn.datatables.net\/scroller\/2.4.3\/css","js":"https:\/\/cdn.datatables.net\/scroller\/2.4.3\/js","resolve":true},"select":{"css":"https:\/\/cdn.datatables.net\/select\/3.0.0\/css","js":"https:\/\/cdn.datatables.net\/select\/3.0.0\/js","resolve":true},"searchbuilder":{"css":"https:\/\/cdn.datatables.net\/searchbuilder\/1.8.2\/css","js":"https:\/\/cdn.datatables.net\/searchbuilder\/1.8.2\/js","resolve":true},"searchpanes":{"css":"https:\/\/cdn.datatables.net\/searchpanes\/2.3.3\/css","js":"https:\/\/cdn.datatables.net\/searchpanes\/2.3.3\/js","resolve":true},"staterestore":{"css":"https:\/\/cdn.datatables.net\/staterestore\/1.4.1\/css","js":"https:\/\/cdn.datatables.net\/staterestore\/1.4.1\/js","resolve":true},"datetime":{"css":"https:\/\/cdn.datatables.net\/datetime\/1.5.5\/css\/dataTables.dateTime.min.css","js":"https:\/\/cdn.datatables.net\/datetime\/1.5.5\/js\/dataTables.dateTime.min.js"},"bootstrap":{"css":"https:\/\/maxcdn.bootstrapcdn.com\/bootstrap\/3.3.7\/css\/bootstrap.min.css","js":"https:\/\/maxcdn.bootstrapcdn.com\/bootstrap\/3.3.7\/js\/bootstrap.min.js"},"bootstrap4":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/twitter-bootstrap\/4.5.2\/css\/bootstrap.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/popper.js\/1.14.3\/umd\/popper.min.js|https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/twitter-bootstrap\/4.5.2\/js\/bootstrap.min.js"},"bootstrap5":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/twitter-bootstrap\/5.3.0\/css\/bootstrap.min.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/twitter-bootstrap\/5.3.0\/js\/bootstrap.bundle.min.js"},"bulma":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/bulma\/1.0.1\/css\/bulma.min.css"},"foundation":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/foundation\/6.4.3\/css\/foundation.min.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/foundation\/6.4.3\/js\/foundation.min.js"},"jqueryui":{"css":"https:\/\/code.jquery.com\/ui\/1.13.2\/themes\/base\/jquery-ui.css","js":"https:\/\/code.jquery.com\/ui\/1.13.2\/jquery-ui.js"},"material":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/material-components-web\/14.0.0\/material-components-web.min.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/material-components-web\/14.0.0\/material-components-web.min.js"},"semanticui":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/fomantic-ui\/2.9.2\/semantic.min.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/fomantic-ui\/2.9.2\/semantic.min.js"},"uikit":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/uikit\/3.0.2\/css\/uikit.min.css","js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/uikit\/3.0.2\/js\/uikit.min.js"},"tailwindcss":{"css":"","js":"https:\/\/cdn.tailwindcss.com"},"font-awesome":{"css":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/font-awesome\/4.7.0\/css\/font-awesome.min.css"},"world-flags-sprite":{"css":"https:\/\/cdn.jsdelivr.net\/gh\/lafeber\/world-flags-sprite\/stylesheets\/flags32-both.css"},"buttons-html5":{"js":"https:\/\/cdn.datatables.net\/buttons\/3.2.2\/js\/buttons.html5.min.js"},"buttons-colvis":{"js":"https:\/\/cdn.datatables.net\/buttons\/3.2.2\/js\/buttons.colVis.min.js"},"buttons-print":{"js":"https:\/\/cdn.datatables.net\/buttons\/3.2.2\/js\/buttons.print.min.js"},"jquery":{"js":"https:\/\/code.jquery.com\/jquery-3.7.1.js"},"jszip":{"js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/jszip\/3.10.1\/jszip.min.js"},"pdfmake":{"js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/pdfmake\/0.2.7\/pdfmake.min.js"},"vfsfonts":{"js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/pdfmake\/0.2.7\/vfs_fonts.js"},"moment":{"js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/moment.js\/2.29.2\/moment.min.js"},"luxon":{"js":"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/luxon\/2.3.1\/luxon.min.js"},"sparkline":{"js":"https:\/\/cdn.jsdelivr.net\/gh\/fnando\/sparkline\/dist\/sparkline.js"}}},
		jquery: function () {
                       $('#example').DataTable({
                	    columnDefs: [
       		                   {
			                orderable: false,
			                className: 'select-checkbox',
			                targets: 0
		                   }
	                    ],
 	                    fixedColumns: {
		                   start: 2
	                    },
	                    order: [[1, 'asc']],
	                    paging: false,
	                    scrollCollapse: true,
	                    scrollX: true,
	                    scrollY: 300,
 	                    select: {
		                         style: 'os',
		                         selector: 'td:first-child'
 	                    }
                       });
	        },

		vanilla: function () {
                       new DataTable('#example', {
	                   columnDefs: [
		                  {
			                  orderable: false,
			                  render: DataTable.render.select(),
			                  targets: 0
	 	                  }
	                   ],
	                   fixedColumns: {
		                  start: 2
	                   },
	                   order: [[1, 'asc']],
	                   paging: false,
	                   scrollCollapse: true,
	                   scrollX: true,
	                   scrollY: 300,
	                   select: {
		                  style: 'os',
		                  selector: 'td:first-child'
	                   }
                       });
		  }
	});
</script>

<table id="example" class="stripe row-border order-column nowrap" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Garrett</td>
                <td>Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
                <td>8422</td>
                <td>g.winters@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Ashton</td>
                <td>Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
                <td>1562</td>
                <td>a.cox@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Cedric</td>
                <td>Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
                <td>6224</td>
                <td>c.kelly@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Airi</td>
                <td>Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
                <td>5407</td>
                <td>a.satou@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Brielle</td>
                <td>Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
                <td>4804</td>
                <td>b.williamson@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Herrod</td>
                <td>Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
                <td>9608</td>
                <td>h.chandler@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Rhona</td>
                <td>Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010-10-14</td>
                <td>$327,900</td>
                <td>6200</td>
                <td>r.davidson@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Colleen</td>
                <td>Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009-09-15</td>
                <td>$205,500</td>
                <td>2360</td>
                <td>c.hurst@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Sonya</td>
                <td>Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008-12-13</td>
                <td>$103,600</td>
                <td>1667</td>
                <td>s.frost@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jena</td>
                <td>Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008-12-19</td>
                <td>$90,560</td>
                <td>3814</td>
                <td>j.gaines@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Quinn</td>
                <td>Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013-03-03</td>
                <td>$342,000</td>
                <td>9497</td>
                <td>q.flynn@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Charde</td>
                <td>Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008-10-16</td>
                <td>$470,600</td>
                <td>6741</td>
                <td>c.marshall@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Haley</td>
                <td>Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012-12-18</td>
                <td>$313,500</td>
                <td>3597</td>
                <td>h.kennedy@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Tatyana</td>
                <td>Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010-03-17</td>
                <td>$385,750</td>
                <td>1965</td>
                <td>t.fitzpatrick@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Michael</td>
                <td>Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012-11-27</td>
                <td>$198,500</td>
                <td>1581</td>
                <td>m.silva@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Paul</td>
                <td>Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010-06-09</td>
                <td>$725,000</td>
                <td>3059</td>
                <td>p.byrd@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Gloria</td>
                <td>Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009-04-10</td>
                <td>$237,500</td>
                <td>1721</td>
                <td>g.little@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Bradley</td>
                <td>Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012-10-13</td>
                <td>$132,000</td>
                <td>2558</td>
                <td>b.greer@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Dai</td>
                <td>Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012-09-26</td>
                <td>$217,500</td>
                <td>2290</td>
                <td>d.rios@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jenette</td>
                <td>Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011-09-03</td>
                <td>$345,000</td>
                <td>1937</td>
                <td>j.caldwell@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Yuri</td>
                <td>Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009-06-25</td>
                <td>$675,000</td>
                <td>6154</td>
                <td>y.berry@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Caesar</td>
                <td>Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011-12-12</td>
                <td>$106,450</td>
                <td>8330</td>
                <td>c.vance@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Doris</td>
                <td>Wilder</td>
                <td>Sales Assistant</td>
                <td>Sydney</td>
                <td>23</td>
                <td>2010-09-20</td>
                <td>$85,600</td>
                <td>3023</td>
                <td>d.wilder@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Angelica</td>
                <td>Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009-10-09</td>
                <td>$1,200,000</td>
                <td>5797</td>
                <td>a.ramos@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Gavin</td>
                <td>Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010-12-22</td>
                <td>$92,575</td>
                <td>8822</td>
                <td>g.joyce@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jennifer</td>
                <td>Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010-11-14</td>
                <td>$357,650</td>
                <td>9239</td>
                <td>j.chang@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Brenden</td>
                <td>Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011-06-07</td>
                <td>$206,850</td>
                <td>1314</td>
                <td>b.wagner@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Fiona</td>
                <td>Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010-03-11</td>
                <td>$850,000</td>
                <td>2947</td>
                <td>f.green@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Shou</td>
                <td>Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011-08-14</td>
                <td>$163,000</td>
                <td>8899</td>
                <td>s.itou@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Michelle</td>
                <td>House</td>
                <td>Integration Specialist</td>
                <td>Sydney</td>
                <td>37</td>
                <td>2011-06-02</td>
                <td>$95,400</td>
                <td>2769</td>
                <td>m.house@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Suki</td>
                <td>Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009-10-22</td>
                <td>$114,500</td>
                <td>6832</td>
                <td>s.burks@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Prescott</td>
                <td>Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011-05-07</td>
                <td>$145,000</td>
                <td>3606</td>
                <td>p.bartlett@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Gavin</td>
                <td>Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008-10-26</td>
                <td>$235,500</td>
                <td>2860</td>
                <td>g.cortez@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Martena</td>
                <td>Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011-03-09</td>
                <td>$324,050</td>
                <td>8240</td>
                <td>m.mccray@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Unity</td>
                <td>Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009-12-09</td>
                <td>$85,675</td>
                <td>5384</td>
                <td>u.butler@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Howard</td>
                <td>Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008-12-16</td>
                <td>$164,500</td>
                <td>7031</td>
                <td>h.hatfield@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Hope</td>
                <td>Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010-02-12</td>
                <td>$109,850</td>
                <td>6318</td>
                <td>h.fuentes@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Vivian</td>
                <td>Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009-02-14</td>
                <td>$452,500</td>
                <td>9422</td>
                <td>v.harrell@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Timothy</td>
                <td>Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008-12-11</td>
                <td>$136,200</td>
                <td>7580</td>
                <td>t.mooney@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jackson</td>
                <td>Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008-09-26</td>
                <td>$645,750</td>
                <td>1042</td>
                <td>j.bradshaw@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Olivia</td>
                <td>Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011-02-03</td>
                <td>$234,500</td>
                <td>2120</td>
                <td>o.liang@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Bruno</td>
                <td>Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011-05-03</td>
                <td>$163,500</td>
                <td>6222</td>
                <td>b.nash@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Sakura</td>
                <td>Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009-08-19</td>
                <td>$139,575</td>
                <td>9383</td>
                <td>s.yamamoto@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Thor</td>
                <td>Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013-08-11</td>
                <td>$98,540</td>
                <td>8327</td>
                <td>t.walton@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Finn</td>
                <td>Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009-07-07</td>
                <td>$87,500</td>
                <td>2927</td>
                <td>f.camacho@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Serge</td>
                <td>Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012-04-09</td>
                <td>$138,575</td>
                <td>8352</td>
                <td>s.baldwin@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Zenaida</td>
                <td>Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010-01-04</td>
                <td>$125,250</td>
                <td>7439</td>
                <td>z.frank@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Zorita</td>
                <td>Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012-06-01</td>
                <td>$115,000</td>
                <td>4389</td>
                <td>z.serrano@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jennifer</td>
                <td>Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013-02-01</td>
                <td>$75,650</td>
                <td>3431</td>
                <td>j.acosta@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Cara</td>
                <td>Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011-12-06</td>
                <td>$145,600</td>
                <td>3990</td>
                <td>c.stevens@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Hermione</td>
                <td>Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011-03-21</td>
                <td>$356,250</td>
                <td>1016</td>
                <td>h.butler@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Lael</td>
                <td>Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009-02-27</td>
                <td>$103,500</td>
                <td>6733</td>
                <td>l.greer@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Jonas</td>
                <td>Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010-07-14</td>
                <td>$86,500</td>
                <td>8196</td>
                <td>j.alexander@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Shad</td>
                <td>Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008-11-13</td>
                <td>$183,000</td>
                <td>6373</td>
                <td>s.decker@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Michael</td>
                <td>Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011-06-27</td>
                <td>$183,000</td>
                <td>5384</td>
                <td>m.bruce@datatables.net</td>
            </tr>
            <tr>
                <td></td>
                <td>Donna</td>
                <td>Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011-01-25</td>
                <td>$112,000</td>
                <td>4226</td>
                <td>d.snider@datatables.net</td>
            </tr>
        </tbody>
    </table>

@endsection
