function formatNumber(num) {
	var cursign=localStorage.getItem('cursign');
	var n1, n2;
	num = num + '' || '';
	// works for integer and floating as well
	n1 = num.split('.');
	n2 = n1[1] || null;
	if(cursign == 'dollar')
	{
		n1 = n1[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	}
	else
	{
		n1 = n1[0].replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
	}
	num = n2 ? n1 + '.' + n2.substring(0,2) : n1;
	return num;
}
function epc_calc(){	
	var land=0,build=0,plant=0,furni=0,pexp=0,tfee=0,sexp=0,rd=0,lfee=0,cmargin=0,interest=0;
	if($('#interest').val() != '')
	{
		interest=accounting.unformat($('#interest').val());
	}
	land=accounting.unformat($('#land').val());
	build=accounting.unformat($('#build').val());
	plant=accounting.unformat($('#plant').val());
	furni=accounting.unformat($('#furniture').val());
	pexp=accounting.unformat($('#preexp').val());
	tfee=accounting.unformat($('#techfee').val());
	sexp=accounting.unformat($('#sexp').val());
	rd=accounting.unformat($('#rd').val()) ;
	lfee=accounting.unformat($('#licensing_fee').val());
	cmargin=accounting.unformat($('#cmargin').val());
	
	
	var tot=0;
	$('.apc').each(function(){
		if($(this).val() != '')
		{
			tot = parseFloat(tot)+parseFloat(accounting.unformat($(this).val()));
		}
	});
	$('#tot').val(formatNumber(parseFloat(tot)+parseFloat(interest)+parseFloat(cmargin)));
	$('#summary1').val(formatNumber(parseFloat(land)+parseFloat(build)+parseFloat(plant)));
	
	var cursign=localStorage.getItem('cursign');
	if(cursign=='dollar')
	{
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix: "$"				
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",	
				dataPoints: [
					{ y: parseFloat(land), label: "1"},
					{ y: parseFloat(build), label: "2"},
					{ y: parseFloat(plant), label: "3"},
					{ y: parseFloat(furni), label: "4"},
					{ y: parseFloat(pexp), label: "5"},
					{ y: parseFloat(tfee), label: "6"},
					{ y: parseFloat(sexp), label: "7"},
					{ y: parseFloat(rd), label: "8"},
					{ y: parseFloat(interest), label: "9"},
					{ y: parseFloat(cmargin), label: "10"},
					{ y: parseFloat(lfee), label: "11"}
				]
			}
			]
		});
	}
	else
	{
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix:"₹"		
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				dataPoints: [
						{ y: parseFloat(land), label: "1"},
						{ y: parseFloat(build), label: "2"},
						{ y: parseFloat(plant), label: "3"},
						{ y: parseFloat(furni), label: "4"},
						{ y: parseFloat(pexp), label: "5"},
						{ y: parseFloat(tfee), label: "6"},
						{ y: parseFloat(sexp), label: "7"},
						{ y: parseFloat(rd), label: "8"},
						{ y: parseFloat(interest), label: "9"},
						{ y: parseFloat(cmargin), label: "10"},
						{ y: parseFloat(lfee), label: "11"}
					]
				/* dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?> */
			}
			]
		});
	}	
	proj_cost.render();
	
	
}
function calc(){
	var ec=accounting.unformat($('#estimate_cost').val());
	var tp=((parseFloat(ec)/100)*10);
	var twp=((parseFloat(ec)/100)*15);
	var thp=((parseFloat(ec)/100)*30);
	var fp=((parseFloat(ec)/100)*5);
	var ep=((parseFloat(ec)/100)*8);
	var sp=((parseFloat(ec)/100)*6);
	var interest=0;
	if($('#interest').val() != '')
	{
		interest=accounting.unformat($('#interest').val());
	}	
	var tot=(parseFloat(tp)+parseFloat(twp)+parseFloat(thp)+(parseFloat(fp)*2)+parseFloat(ep)+(parseFloat(sp)*2)+parseFloat(tp)+parseFloat(interest)+parseFloat(accounting.unformat($('#licensing_fee').val())));
	
	$('#land').val(formatNumber(tp));
	$('#build').val(formatNumber(twp));
	$('#plant').val(formatNumber(thp));
	$('#furniture').val(formatNumber(fp));
	$('#preexp').val(formatNumber(fp));
	$('#techfee').val(formatNumber(ep));
	$('#sexp').val(formatNumber(sp));
	$('#rd').val(formatNumber(sp));
	$('#licensing_fee').val(formatNumber(fp));
	$('#cmargin').val(formatNumber(tp));			
	$('#tot').val(formatNumber(tot));
	$('#summary1').val(formatNumber(parseFloat(tp)+parseFloat(twp)+parseFloat(thp)));
	
	var cursign=localStorage.getItem('cursign');
	if(cursign=='dollar')
	{
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix: "$"				
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",	
				dataPoints: [
					{ y: parseFloat(tp), label: "1"},
					{ y: parseFloat(twp), label: "2"},
					{ y: parseFloat(thp), label: "3"},
					{ y: parseFloat(fp), label: "4"},
					{ y: parseFloat(fp), label: "5"},
					{ y: parseFloat(ep), label: "6"},
					{ y: parseFloat(sp), label: "7"},
					{ y: parseFloat(sp), label: "8"},
					{ y: parseFloat(accounting.unformat($('#interest').val())), label: "9"},
					{ y: parseFloat(tp), label: "10"},
					{ y: parseFloat(fp), label: "11"}
				]
			}
			]
		});
	}
	else
	{
		var proj_cost = new CanvasJS.Chart("barchart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: "Project Cost"
			},
			axisY: {				
				prefix:"₹"		
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				dataPoints: [
						{ y: parseFloat(tp), label: "1"},
						{ y: parseFloat(twp), label: "2"},
						{ y: parseFloat(thp), label: "3"},
						{ y: parseFloat(fp), label: "4"},
						{ y: parseFloat(fp), label: "5"},
						{ y: parseFloat(ep), label: "6"},
						{ y: parseFloat(sp), label: "7"},
						{ y: parseFloat(sp), label: "8"},
						{ y: parseFloat(accounting.unformat($('#interest').val())), label: "9"},
						{ y: parseFloat(tp), label: "10"},
						{ y: parseFloat(fp), label: "11"}
					]
				/* dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?> */
			}
			]
		});
	}	
	proj_cost.render();
	
	
}

function calc_2()
{
	var tot=parseFloat(accounting.unformat($('#land').val()))+
	parseFloat(accounting.unformat($('#build').val()))+
	parseFloat(accounting.unformat($('#plant').val()))+
	parseFloat(accounting.unformat($('#furniture').val()))+
	parseFloat(accounting.unformat($('#preexp').val()))+
	parseFloat(accounting.unformat($('#techfee').val()))+
	parseFloat(accounting.unformat($('#sexp').val()))+
	parseFloat(accounting.unformat($('#rd').val()))+			
	parseFloat(accounting.unformat($('#cmargin').val()))+parseFloat(accounting.unformat($('#interest').val()))+parseFloat(accounting.unformat($('#licensing_fee').val()));
	$('#tot').val(formatNumber(tot));		
	
	
	var peq=0;
	if($('#promoter_stake').val() != '')
	{
		peq=((parseFloat(tot)/100) * parseFloat(accounting.unformat($('#promoter_stake').val()))).toFixed(2);
	}
	$('#pequ').val(formatNumber(peq));
	$('#eqinves').val(formatNumber(peq));
	$('#lninves').val(formatNumber(parseFloat(tot)-parseFloat(peq)));	
	$('#totinves').val(formatNumber(parseFloat(tot)));
	$('#eqinvesper').val(formatNumber(accounting.unformat($('#promoter_stake').val())));
	$('#lninvesper').val(formatNumber(100-parseFloat(accounting.unformat($('#promoter_stake').val()))));
	$('#der').val(formatNumber((parseFloat(tot)-parseFloat(peq))/parseFloat(peq)));
	
	var lnom=0,lpa=0,lint=0,aint=0;
	
	lnom = accounting.unformat($('#termloan_nom').val());
	lint = accounting.unformat($('#termloan_interest').val());
	if(parseInt(lnom) > 0)
	{		
		lpa=(((parseFloat(tot)-parseFloat(peq))/parseFloat(lnom))*12);
		
	}
	if(parseFloat(lint) > 0)
	{
		aint=(((parseFloat(tot)-parseFloat(peq))/100)*parseFloat(lint));
	}
	$('#lnperannum').val(formatNumber(lpa));
	$('#aninterest').val(formatNumber(aint));
	$('#ancommit').val(formatNumber(parseFloat(aint)+parseFloat(lpa)));
	$('#interest').val(formatNumber((parseFloat(aint)/12)*9));	
	$('#fincost1').val(formatNumber(parseFloat(tot)-parseFloat(peq)));
	$('#fincost2').val(formatNumber(lint));
	$('#fincost5').val(formatNumber(parseFloat(aint)+parseFloat(lpa)));
}

function prod_cost_cal()
{
	var nod=accounting.unformat($('#nofday_perprod').val());
	var cu=accounting.unformat($('#capacity_utiliz').val());
	var ic=accounting.unformat($('#installed_capacity').val());
	var nom=0,ppa=0,cpc=0,nou=0,wip=0,ostock=0,fp=0,totp=0,dc=0,ppu=0;
	dc=accounting.unformat($('#directcost').val());
	wip=accounting.unformat($('#work_in_progress').val());
	fp=accounting.unformat($('#finishedprod_wip').val());
	if(cu != '' && nod !='')
	{
		nom=(parseFloat(nod)/30);
		ppa=(12/parseFloat(nom)).toFixed(0);
		cpc=((parseFloat(ic)*(parseFloat(cu)/100))/parseFloat(nom));
		if(wip != '')
		{
			ostock=((parseFloat(ic)/100)*parseFloat(wip)).toFixed(0);
		}
		nou=((parseFloat(ostock)/100)*parseFloat(fp)).toFixed(0);
		totp=(parseFloat(cpc)+parseFloat(nou)).toFixed(0);
		ppu=(parseFloat(dc)/parseFloat(totp));
	}		
	$('#prodcycle_nom').val(formatNumber(nom));
	$('#nop_perannum').val(formatNumber(ppa));
	$('#up_cprodcyle').val(formatNumber(cpc));
	$('#wip_nou').val(formatNumber(ostock));
	$('#nouproduced').val(formatNumber(nou));
	$('#totprod_wip').val(formatNumber(totp));
	$('#cost_perunit').val(formatNumber(ppu));	
	$('#fincost3').val(formatNumber(parseFloat(accounting.unformat($('#lnperannum').val()))*parseFloat(nom)));
	$('#fincost4').val(formatNumber(parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat(nom)));
	
}
function manpower_cal()
{
	for(var j=1;j<=5;j++)
	{
		if($('#r2c'+j).val() != '')
		{
			var t = (accounting.unformat($('#r2c'+j).val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
			$('#r3c'+j).val(formatNumber(t));			
			$('#r4c'+j).val(formatNumber(parseFloat(t)*parseFloat(accounting.unformat($('#r1c'+j).val()))));
		}
		
		if($('#r5c'+j).val() != '')
		{
			$('#r6c'+j).val(formatNumber((accounting.unformat($('#r5c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));		
		}
		if($('#r7c'+j).val() != '')
		{
			$('#r8c'+j).val(formatNumber((accounting.unformat($('#r7c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));			
		}
		if($('#r9c'+j).val() != '')
		{
			$('#r10c'+j).val(formatNumber((accounting.unformat($('#r9c'+j).val()))*parseFloat(accounting.unformat($('#r1c'+j).val()))));		
		}
		
		if($('#r4c'+j).val() == '')
			$('#r4c'+j).val(0);
		if($('#r6c'+j).val() == '')
			$('#r6c'+j).val(0);
		if($('#r8c'+j).val() == '')
			$('#r8c'+j).val(0);
		if($('#r10c'+j).val() == '')
			$('#r10c'+j).val(0);
		
		$('#r11c'+j).val(formatNumber((accounting.unformat($('#r4c'+j).val()))+(accounting.unformat($('#r6c'+j).val()))+(accounting.unformat($('#r8c'+j).val()))+(accounting.unformat($('#r10c'+j).val()))));
	}	
	
	for(var i=1;i<=11;i++)
	{
		var tot=0;
		for(var j=1;j<=5;j++)
		{
			if($('#r'+i+'c'+j).val() != '')
			{
				tot += (accounting.unformat($('#r'+i+'c'+j).val())) ;
			}
		}
		$('#r'+i+'c6').val(formatNumber(tot));
	}	
}

function inventory_cal()
{	
	var cu=accounting.unformat($('#cost_perunit').val());
	var ic=accounting.unformat($('#installed_capacity').val());
	var rm=accounting.unformat($('#rawmaterial').val());
	var fg=accounting.unformat($('#finishedgoods').val());
	var rmnou=0,crm=0,fgnou=0,cfg=0,totinvcost=0;
	if(rm != '' && ic != '')
	{
		rmnou = (parseFloat(ic)/100) * parseFloat(rm);
		crm = parseFloat(rmnou) * ((parseFloat(cu)*30)/100);
		fgnou = (parseFloat(ic)/100) * parseFloat(fg);
		cfg = parseFloat(fgnou) * parseFloat(cu);
		totinvcost = parseFloat(crm) + parseFloat(cfg);		
	}
	$('#rmnou').val((rmnou).toFixed(0));
	$('#crm').val(formatNumber(crm));
	$('#fgnou').val((fgnou).toFixed(0));
	$('#cfg').val(formatNumber(cfg));
	$('#totinvcost').val(formatNumber(totinvcost));
	$('#rwc_inv').val(formatNumber(totinvcost));
	req_working_capital();
}

function directcost_cal()
{
	var rmdc=0,wagesdc=0,pidc=0,welfaredc=0,bonusdc=0,power=0,water=0,training=0,transport=0,totdc=0;	
	rmdc = (parseFloat(accounting.unformat($('#installed_capacity').val()))*30)/100;
	wagesdc = parseFloat(accounting.unformat($('#r4c4').val())) ;
	pidc = parseFloat(accounting.unformat($('#r8c4').val()));
	welfaredc = parseFloat(accounting.unformat($('#r6c4').val()));
	bonusdc = parseFloat(accounting.unformat($('#r10c4').val()));		
	power=accounting.unformat($('#power').val());
	water=accounting.unformat($('#water').val());
	training=accounting.unformat($('#training').val());
	transport=accounting.unformat($('#transport').val());
	
	totdc= parseFloat(rmdc)+parseFloat(wagesdc)+parseFloat(pidc)+parseFloat(welfaredc)+parseFloat(bonusdc)+parseFloat(power)+parseFloat(water)+parseFloat(training)+parseFloat(transport);
	
	$('#rmdc').val(formatNumber(rmdc));
	$('#wagesdc').val(formatNumber(wagesdc));
	$('#pidc').val(formatNumber(pidc));
	$('#welfaredc').val(formatNumber(welfaredc));
	$('#bonusdc').val(formatNumber(bonusdc));
	$('#totdc').val(formatNumber(totdc));
	$('#directcost').val(formatNumber(totdc));
	$('#rwc_dc').val(formatNumber(totdc));	
	$('#summary2').val(formatNumber(totdc));
	prod_cost_cal();
	inventory_cal();
	req_working_capital();
	prod_cost_chart();
	
}
function indirectcost_cal()
{	
	var indc1=0,indc2=0,indc3=0,indc4=0,indc5=0,indc6=0,indc7=0,totindc=0;	
	indc1 = (parseFloat(accounting.unformat($('#r4c1').val()))/12);
	indc2 = (parseFloat(accounting.unformat($('#r4c2').val()))/12);
	indc3 = (parseFloat(accounting.unformat($('#r4c3').val()))/12);
	indc4 = (parseFloat(accounting.unformat($('#r4c5').val()))/12);
	indc5 = ((parseFloat(accounting.unformat($('#r6c6').val())) - parseFloat(accounting.unformat($('#r6c4').val()))) / 12);
	indc6 = ((parseFloat(accounting.unformat($('#r8c6').val())) - parseFloat(accounting.unformat($('#r8c4').val()))) / 12);
	indc7 = ((parseFloat(accounting.unformat($('#r10c6').val())) - parseFloat(accounting.unformat($('#r10c4').val()))) / 12);	
	
	$('.indc').each(function(){
		if($(this).val() != '')
		{
			totindc = parseFloat(totindc) + parseFloat($(this).val());
		}
	});	
	totindc = parseFloat(totindc) + parseFloat(indc1)+parseFloat(indc2)+parseFloat(indc3)+parseFloat(indc4)+parseFloat(indc5)+parseFloat(indc6)+parseFloat(indc7);
	
	$('#indc1').val(formatNumber(indc1));
	$('#indc2').val(formatNumber(indc2));
	$('#indc3').val(formatNumber(indc3));
	$('#indc4').val(formatNumber(indc4));
	$('#indc5').val(formatNumber(indc5));
	$('#indc6').val(formatNumber(indc6));
	$('#indc7').val(formatNumber(indc7));	
	$('#totindc').val(formatNumber(totindc));
	$('#rwc_indc').val(formatNumber(totindc));
	$('#summary3').val(formatNumber(totindc));
	req_working_capital();
	deposit_cal();
	
}
function req_working_capital()
{
	$('#rwc_tot').val(formatNumber(parseFloat(accounting.unformat($('#rwc_dc').val()))+parseFloat(accounting.unformat($('#rwc_indc').val()))+parseFloat(accounting.unformat($('#rwc_inv').val()))));
	$('#fincost6').val(formatNumber(parseFloat(accounting.unformat($('#rwc_dc').val()))+parseFloat(accounting.unformat($('#rwc_indc').val()))+parseFloat(accounting.unformat($('#rwc_inv').val()))));
}
function deposit_cal()
{
	var rent_dep=0,fd_bank=0,totdep=0;		
	rent_dep = parseFloat(accounting.unformat($('#rent_deposit').val())) ;
	fd_bank = parseFloat(accounting.unformat($('#fd_bank').val()));
	/* if(rent_dep != '' && fd_bank != '')
	{
		
	} */
	totdep= parseFloat(rent_dep)+parseFloat(fd_bank);
	$('#deptot').val(formatNumber(totdep));		
}
function finance_cal()
{
	var findep1=0,findep2=0,findep3=0,findep4=0,findep5=0,findep6=0,findep7=0,findep8=0,findep9=0,findep10=0,findep11=0,findep12=0,findep13=0,findep14=0;
	findep1=accounting.unformat($('#lninves').val());
	findep2=accounting.unformat($('#termloan_interest').val());
	findep3=parseFloat(accounting.unformat($('#lnperannum').val()))*parseFloat($('#prodcycle_nom').val());
	findep4=parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat($('#prodcycle_nom').val());
	findep5=accounting.unformat($('#ancommit').val());
	findep6=accounting.unformat($('#rwc_tot').val());
	findep7=((parseFloat(accounting.unformat($('#rwc_tot').val())) - parseFloat(accounting.unformat($('#fincost13').val())))*90)/100;
	if($('#wc_loan_interest').val() != '')
	{
		findep8 = accounting.unformat($('#wc_loan_interest').val());
	}
	findep9= parseFloat(accounting.unformat($('#aninterest').val()))*parseFloat(accounting.unformat($('#prodcycle_nom').val()));
	findep10=parseFloat(findep6)-parseFloat(findep7);
	findep11=accounting.unformat($('#wagesdc').val());
	if($('#interest_free').val() != '')
	{
		findep12 = accounting.unformat($('#interest_free').val());
	}
	findep13=((parseFloat(findep11)/100)*findep12) ;
	findep14=parseFloat(findep5)+parseFloat(findep9)+parseFloat(findep13);
	
	$('#fincost1').val(formatNumber(findep1));
	$('#fincost2').val(parseFloat(findep2).toFixed(2));
	$('#fincost3').val(formatNumber(findep3));
	$('#fincost4').val(formatNumber(findep4));
	$('#fincost5').val(formatNumber(findep5));
	$('#fincost6').val(formatNumber(findep6));
	$('#fincost7').val(formatNumber(findep7));
	$('#fincost9').val(formatNumber(findep9));
	$('#fincost10').val(formatNumber(findep10));
	$('#fincost11').val(formatNumber(findep11));
	$('#fincost13').val(formatNumber(findep13));
	$('#fincost14').val(formatNumber(findep14));
	$('#summary5').val(formatNumber(findep14));
	
}

function sale_mark_cal()
{
	var s1=0,s2=0,s3=0,s4=0,s5=0,tots=0,sc1=0,sc2=0,sc3=0,sc4=0,sc5=0,totsc=0;
	s1=accounting.unformat($('#advertise').val());
	s2=accounting.unformat($('#salesexp').val());
	s3=accounting.unformat($('#r8c2').val());
	s4=accounting.unformat($('#add_incentive').val())*accounting.unformat($('#r1c2').val());
	s5=accounting.unformat($('#add_salesexp').val());
	tots=parseFloat(s1)+parseFloat(s2)+parseFloat(s3)+parseFloat(s4)+parseFloat(s5);
	
	sc1 = accounting.unformat($('#land').val())+accounting.unformat($('#build').val())+accounting.unformat($('#plant').val());
	sc2 = accounting.unformat($('#totdc').val());
	sc3 = accounting.unformat($('#totindc').val());
	sc4 = tots;
	sc5 = accounting.unformat($('#fincost14').val());
	totsc=parseFloat(sc1)+parseFloat(sc2)+parseFloat(sc3)+parseFloat(sc4)+parseFloat(sc5);
	
	$('#smcost1').val(formatNumber(s1));
	$('#smcost2').val(formatNumber(s2));
	$('#smcost3').val(formatNumber(s3));
	$('#smcost4').val(formatNumber(s4));
	$('#smcost5').val(formatNumber(s5));
	$('#smcost6').val(formatNumber(tots));
	
	$('#summary1').val(formatNumber(sc1));
	$('#summary2').val(formatNumber(sc2));
	$('#summary3').val(formatNumber(sc3));
	$('#summary4').val(formatNumber(sc4));
	$('#summary5').val(formatNumber(sc5));
	$('#summary6').val(formatNumber(totsc));
	
	$('#summaryper1').val(((parseFloat(sc1)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper2').val(((parseFloat(sc2)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper3').val(((parseFloat(sc3)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper4').val(((parseFloat(sc4)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper5').val(((parseFloat(sc5)/parseFloat(totsc))*100).toFixed(2) + '%');
	$('#summaryper6').val(((parseFloat(totsc)/parseFloat(totsc))*100).toFixed(2) + '%');
	
}

function prod_sales_cost_cal()
{	
	var ps1=0,ps2=0,ps3=0;
	ps1=parseFloat(accounting.unformat($('#summary6').val()))/parseFloat(accounting.unformat($('#totprod_wip').val()));
	ps2=parseFloat(ps1)+((parseFloat(ps1)/100)*parseFloat(accounting.unformat($('#profit_margin').val())));
	ps3=parseFloat(ps2)-((parseFloat(ps2)/100)*parseFloat(accounting.unformat($('#sales_discount').val())));
	
	$('#psc1').val(formatNumber(ps1));
	$('#psc2').val(formatNumber(ps1));
	$('#psc4').val(formatNumber(ps2));
	$('#psc6').val(formatNumber(ps3));	
}

function sales_particular_cal()
{	
	var salesp1=0,salesp2=0,salesp3=0,salesp4=0,salesp5=0,salesp6=0,salesp7=0,salesp8=0,salesp9=0,salesp10=0,salesp11=0,salesp12=0,salesp13=0,salesp14=0;
	
	salesp1=parseFloat(accounting.unformat($('#totprod_wip').val()))+parseFloat(accounting.unformat($('#fgnou').val()));
	salesp2=accounting.unformat($('#sales_target').val());
	salesp3=(parseFloat(salesp1)/100)*parseFloat(salesp2);
	salesp4=accounting.unformat($('#sales_achieved').val());
	salesp5=(parseFloat(salesp3)/100)*parseFloat(salesp4);
	salesp6=((parseFloat(salesp5)*4)/100);
	salesp7=((parseFloat(salesp5)*4)/100);
	salesp8=((parseFloat(salesp5)*4)/100);
	salesp9=((parseFloat(salesp5)*2)/100)+((parseFloat(accounting.unformat($('#training').val()))*2)/100);
	salesp10=parseFloat(salesp5)+parseFloat(salesp6)+parseFloat(salesp7)+parseFloat(salesp8)+parseFloat(salesp9);
	if(salesp3 >0)
	{
		salesp11=(parseFloat(salesp10)/parseFloat(salesp3))*100;
	}
	salesp12=accounting.unformat($('#sales_cash').val());	
	salesp14=(parseFloat(salesp10)/100)*parseFloat(salesp12);
	salesp13=((parseFloat(salesp10) - parseFloat(salesp14))/parseFloat(salesp10))*100;
	salesp15=(parseFloat(salesp10) - parseFloat(salesp14));
	salesp16=accounting.unformat($('#doubtful_crsale').val());
	salesp17=(parseFloat(salesp15)/100)*parseFloat(salesp16);	
	
	$('#salesp1').val(formatNumber(salesp1));
	$('#salesp3').val(formatNumber(salesp3));	
	$('#salesp5').val(formatNumber(salesp5));
	$('#salesp6').val(formatNumber(salesp6));
	$('#salesp7').val(formatNumber(salesp7));
	$('#salesp8').val(formatNumber(salesp8));
	$('#salesp9').val(formatNumber(salesp9));
	$('#salesp10').val(formatNumber(salesp10));
	$('#salesp11').val(formatNumber(salesp11));
	$('#salesp13').val(formatNumber(salesp13));
	$('#salesp14').val(formatNumber(salesp14));
	$('#salesp15').val(formatNumber(salesp15));
	$('#salesp17').val(formatNumber(salesp17));
}

function revenue_cal()
{
	var rev1=0,rev2=0,rev3=0,rev4=0,rev5=0,rev6=0,rev7=0,rev8=0,rev9=0,rev10=0,rev11=0,rev12=0,rev13=0;
	rev1=(parseFloat(accounting.unformat($('#salesp10').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev2=(parseFloat(accounting.unformat($('#salesp14').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev3=((parseFloat(accounting.unformat($('#salesp15').val())) - parseFloat(accounting.unformat($('#salesp17').val())))*parseFloat(accounting.unformat($('#psc6').val())));
	rev4=(parseFloat(accounting.unformat($('#salesp17').val())) * parseFloat(accounting.unformat($('#psc6').val())));
	rev5=(parseFloat(rev2) + parseFloat(rev3) + parseFloat(rev4));
	rev6=(parseFloat(accounting.unformat($('#summary6').val())) - parseFloat(accounting.unformat($('#summary1').val())));
	rev7=parseFloat(rev5) - parseFloat(rev6);
	if(parseFloat(rev7)>0)
	{
		rev8=(parseFloat(rev7)/100)*5;
		rev9=(parseFloat(rev7)/100)*95;
	}
	
	rev10=parseFloat(rev4);	
	rev11= (parseFloat(rev10) / parseFloat(rev1))*100;
	rev12=parseFloat(accounting.unformat($('#fincost13').val()));	
	rev13=(parseFloat(rev12) / parseFloat(rev1))*100;	
	
	$('#reven1').val(formatNumber(rev1));$('#reven2').val(formatNumber(rev2));$('#reven3').val(formatNumber(rev3));$('#reven4').val(formatNumber(rev4));$('#reven5').val(formatNumber(rev5));$('#reven6').val(formatNumber(rev6));$('#reven7').val(formatNumber(rev7));$('#reven8').val(formatNumber(rev8));$('#reven9').val(formatNumber(rev9));$('#reven10').val(formatNumber(rev10));$('#reven11').val(parseFloat(rev11).toFixed(2));$('#reven12').val(formatNumber(rev12));$('#reven13').val(parseFloat(rev13).toFixed(2));
	
}


function cashflow_cal()
{
	var cflow1=0,cflow2=0,cflow3=0,cflow4=0,cflow5=0,cflow6=0,cflow7=0,cflow8=0,cflow9=0,cflow10=0,prf_at=0,prf_bt=0;
	cflow1 = accounting.unformat($('#summary2').val());
	cflow2 = accounting.unformat($('#summary3').val());
	cflow3 = accounting.unformat($('#summary4').val());
	cflow4 = accounting.unformat($('#summary5').val());	
	cflow5 = ((accounting.unformat($('#plant').val())/100)*15) + ((accounting.unformat($('#build').val())/100)*3) + ((accounting.unformat($('#furniture').val())/100)*30);
	cflow6 = (accounting.unformat($('#reven1').val())/100)*4;
	
	cflow7 = parseFloat(cflow1) + parseFloat(cflow2) + parseFloat(cflow3) + parseFloat(cflow4) + parseFloat(cflow5) + parseFloat(cflow6);
	
	cflow8 = accounting.unformat($('#reven5').val());
	cflow9 = (parseFloat(cflow8)/100)*5;
	cflow10 = parseFloat(cflow8)+parseFloat(cflow9);	
		
	prf_bt = parseFloat(cflow10) - (parseFloat(cflow1) + parseFloat(cflow2) + parseFloat(cflow3) + parseFloat(cflow4) + parseFloat(cflow5));
	prf_at = parseFloat(cflow10) - parseFloat(cflow7);
	
	$('#cflow1').val(formatNumber(cflow1));$('#cflow2').val(formatNumber(cflow2));$('#cflow3').val(formatNumber(cflow3));$('#cflow4').val(formatNumber(cflow4));$('#cflow5').val(formatNumber(cflow5));$('#cflow6').val(formatNumber(cflow6));$('#cflow7').val(formatNumber(cflow7));$('#cflow8').val(formatNumber(cflow8));$('#cflow9').val(formatNumber(cflow9));$('#cflow10').val(formatNumber(cflow10));
	$('#profitbt').val(formatNumber(prf_bt));
	$('#profitat').val(formatNumber(prf_at));
	
}
/************************* Charts ******************************/
var cursign=localStorage.getItem('cursign');
function debt_chart()
{
	if(cursign=='dollar')
	{
		var means = new CanvasJS.Chart("equity_chart", {
			title: {
				text: "DEBT - EQUITY"
			},
			animationEnabled: true,
			legend: {
				verticalAlign: "center",
				horizontalAlign: "left",
				fontSize: 16,
				fontFamily: "Helvetica"
			},
			theme: "light2",
			data: [
			{			
				type: "pie",
				showInLegend: true,
				toolTipContent: "{name}",
				indexLabelFontFamily: "Garamond",
				indexLabelFontSize: 16,
				indexLabelFontColor: "#fff",
				indexLabel: "${y}",
				legendText: "${y} ",
				indexLabelPlacement: "inside",
				dataPoints: [
					{ y: accounting.unformat($('#lninves').val()), name: "DEBT",legendText: "DEBT",exploded: true },
					{ y: accounting.unformat($('#pequ').val()), name: "EQUITY",legendText: "EQUITY",exploded: true }
					
				]
			}
			]
		});
	}
	else
	{
		var means = new CanvasJS.Chart("equity_chart", {
		title: {
			text: "DEBT - EQUITY"
		},
		animationEnabled: true,
		legend: {
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 16,
			fontFamily: "Helvetica"
		},
		theme: "light2",
		data: [
		{			
			type: "pie",
			showInLegend: true,
			toolTipContent: "{name}",
			indexLabelFontFamily: "Garamond",
			indexLabelFontSize: 16,
			indexLabelFontColor: "#fff",
			indexLabel: "₹{y}",
			legendText: "₹{y} ",
			indexLabelPlacement: "inside",
			dataPoints: [
				{ y: accounting.unformat($('#lninves').val()), name: "DEBT",legendText: "DEBT",exploded: true },
				{ y: accounting.unformat($('#pequ').val()), name: "EQUITY",legendText: "EQUITY",exploded: true }
				
			]
		}
		]
	});
	}
	means.render();
}
function profit_chart()
{
	$('.prof_chart').each(function(){
		var id=$(this).attr('id');
		if(cursign=='dollar')
		{
			var profit = new CanvasJS.Chart(id, {
				title: {
					text: "PROFITABILITY"
				},
				animationEnabled: true,
				legend: {
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 16,
					fontFamily: "Helvetica"
				},
				theme: "light2",
				data: [
				{			
					type: "pie",
					showInLegend: true,
					toolTipContent: "{name}",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 16,
					indexLabelFontColor: "#fff",
					indexLabel: "${y}",
					legendText: "${y} ",
					indexLabelPlacement: "inside",
					dataPoints: [
						{ y: accounting.unformat($('#profitbt').val()), name: "BEFORE TAX",legendText: "BEFORE TAX",exploded: true},
						{ y: accounting.unformat($('#profitat').val()), name: "AFTER TAX",legendText: "AFTER TAX" ,exploded: true}					
					]
				}
				]
			});
		}
		else
		{
			var profit = new CanvasJS.Chart(id, {
				title: {
					text: "PROFITABILITY"
				},
				animationEnabled: true,
				legend: {
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 16,
					fontFamily: "Helvetica"
				},
				theme: "light2",
				data: [
				{			
					type: "pie",
					showInLegend: true,
					toolTipContent: "{name}",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 16,
					indexLabelFontColor: "#fff",
					indexLabel: "₹{y}",
					legendText: "₹{y} ",
					indexLabelPlacement: "inside",
					dataPoints: [
						{ y: accounting.unformat($('#profitbt').val()), name: "BEFORE TAX",legendText: "BEFORE TAX",exploded: true},
						{ y: accounting.unformat($('#profitat').val()), name: "AFTER TAX",legendText: "AFTER TAX" ,exploded: true}					
					]
				}
				]
			});
		}
		profit.render();
	});
}
function distri_chart()
{
	var sum1=0;sum2=0;sum3=0;sum4=0;sum5=0;
	sum1=($('#summaryper1').val()).slice(0, ($('#summaryper1').val()).indexOf('%'));
	sum2=($('#summaryper2').val()).slice(0, ($('#summaryper2').val()).indexOf('%'));
	sum3=($('#summaryper3').val()).slice(0, ($('#summaryper3').val()).indexOf('%'));
	sum4=($('#summaryper4').val()).slice(0, ($('#summaryper4').val()).indexOf('%'));
	sum5=($('#summaryper5').val()).slice(0, ($('#summaryper5').val()).indexOf('%'));
	var dischart = new CanvasJS.Chart("distri_chart", {
		title: {
			text: "DISTRIBUTION OF COST"
		},
		animationEnabled: true,
		legend: {
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 16,
			fontFamily: "Helvetica"
		},
		theme: "light2",
		data: [
		{			
			type: "pie",
			showInLegend: true,
			toolTipContent: "{name}",
			indexLabelFontFamily: "Garamond",
			indexLabelFontSize: 16,
			indexLabelFontColor: "#fff",
			indexLabel: "{y} %",
			legendText: "{y} %",
			indexLabelPlacement: "inside",
			dataPoints: [
				{ y: accounting.unformat(sum1), name: "CAPITAL COSTS",legendText: "CAPITAL COSTS",exploded: true},
				{ y: accounting.unformat(sum2), name: "DIRECT COSTS",legendText: "DIRECT COSTS" ,exploded: true},
				{ y: accounting.unformat(sum3), name: "INDIRECT COSTS",legendText: "INDIRECT COSTS",exploded: true },
				{ y: accounting.unformat(sum4), name: "MARKETING COSTS",legendText: "MARKETING COSTS",exploded: true },
				{ y: accounting.unformat(sum5), name: "FINANCIAL COSTS",legendText: "FINANCIAL COSTS",exploded: true }
			]
		}
		]
	});
	dischart.render();
	
}

function prod_cost_chart()
{
	
	var cpu = accounting.unformat($('#cost_perunit').val());
	if(cursign=='dollar')
	{
		var prod_cost = new CanvasJS.Chart("prodchart", {		
			animationEnabled: true,
			theme: "light2", 
			title:{
				text: "PRODUCTION COST"
			},	
			axisX:{
				labelFontColor:"#FFFFFF"
			},	
			axisY: {
				prefix: "$"				
			},
			data: [{        
				type: "column",  
				showInLegend: true, 
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",
				indexLabel: "${y}",
				legendText: "PRODUCTION COST PER UNIT",
				dataPoints: [  
					{ y: parseFloat(cpu), name: "PRODUCTION COST PER UNIT" }				
				]
			}]
		});
	}
	else
	{
		var prod_cost = new CanvasJS.Chart("prodchart", {		
			animationEnabled: true,
			theme: "light2", 
			title:{
				text: "PRODUCTION COST"
			},	
			axisX:{
				labelFontColor:"#FFFFFF"
			},	
			axisY: {				
				prefix:"₹"		
			},
			data: [{        
				type: "column",  
				showInLegend: true, 
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				indexLabel: "₹{y}",
				legendText: "PRODUCTION COST PER UNIT",
				dataPoints: [  
					{ y: parseFloat(cpu), name: "PRODUCTION COST PER UNIT" }				
				]
			}]
		});
	}
	prod_cost.render();
}

function req_work_capital_chart()
{
	var cursign=localStorage.getItem('cursign');
	if(cursign=='dollar')
	{
		var req_work = new CanvasJS.Chart("rwc_chart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: ""
			},
			axisY: {				
				prefix: "$"				
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "${y}",	
				dataPoints: [
					{ y: parseFloat(accounting.unformat($('#rwc_dc').val())), label: "Direct Costs"},
					{ y: parseFloat(accounting.unformat($('#rwc_indc').val())), label: "Indirect Costs"},
					{ y: parseFloat(accounting.unformat($('#rwc_inv').val())), label: "Inventory Costs"}
				]
			}
			]
		});
	}
	else
	{
		var req_work = new CanvasJS.Chart("rwc_chart", {
			theme: "theme2",
			animationEnabled: true,
			title: {
				text: ""
			},
			axisY: {				
				prefix:"₹"		
			},	
			data: [
			{
				type: "column",
				yValueFormatString: "#,##0.00",
				toolTipContent: "₹{y}",
				dataPoints: [
						{ y: parseFloat(accounting.unformat($('#rwc_dc').val())), label: "Direct Costs"},
						{ y: parseFloat(accounting.unformat($('#rwc_indc').val())), label: "Indirect Costs"},
						{ y: parseFloat(accounting.unformat($('#rwc_inv').val())), label: "Inventory Costs"}
					]
			}
			]
		});
	}	
	req_work.render();
}

// When the browser is ready...
$(function() { 
	prod_cost_cal(); manpower_cal(); inventory_cal(); directcost_cal();indirectcost_cal();finance_cal(); deposit_cal(); sale_mark_cal();prod_sales_cost_cal();sales_particular_cal();revenue_cal();cashflow_cal();
	$('.numeric').keyup(function(event) {
	  // skip for arrow keys
		if(event.which >= 37 && event.which <= 40) return;
		if(cursign == 'dollar')
		{
			  // format number
			$(this).val(function(index, value) {
				return value
				.replace(/\D/g, "")
				.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
				;
			});
		}
		else
		{
			  // format number
			$(this).val(function(index, value) {
				return value
				.replace(/\D/g, "")
				.replace(/(\d)(?=(\d\d)+\d$)/g, "$1,")
				;
			});
		}
	});
	
	$('#estimate_cost').on('blur',function(){
		if($(this).val() != '')
		{
			for(var i=0;i<2;i++)
			{
				calc();
			}			
		}		
	});	
	$('.apc').on('change',function(){
		if($(this).val() != '')
		{
			calc_2();
			epc_calc();
			calc_2();
		}		
	});		
	$('#promoter_stake,#termloan_nom,#termloan_interest').on('blur',function(){	
		for(var i=1;i<=3;i++)
		{
			calc_2();
			epc_calc();
			calc_2();	
		}
		debt_chart();
		profit_chart();
	});	
	   
	$('#installed_capacity,#nofday_perprod,#work_in_progress,#finishedprod_wip,#capacity_utiliz').on('blur',function(){
		var ic=accounting.unformat($('#installed_capacity').val());
		var dc=0;
		if(ic != '')
		{
			dc=((parseFloat(ic)/100)*30).toFixed(2);
		}
		$('#directcost').val(formatNumber(dc));		
		prod_cost_cal();
		profit_chart();prod_cost_chart();
		
	});
	
	   
	$('.rows').on('blur',function(){		
		manpower_cal();	
		profit_chart();		
	});
	$('#rawmaterial,#finishedgoods').on('blur',function(){		
		inventory_cal();
		profit_chart();
	});
	$('.dc').on('change',function(){
		directcost_cal();
		profit_chart();
	});
	$('.indc').on('blur',function(){
		indirectcost_cal();
		profit_chart();
	});
	$('#wc_loan_interest,#interest_free').on('blur',function(){
		finance_cal();
		profit_chart();
		
	});
	$('#fd_bank').on('blur',function(){		
		deposit_cal();
		profit_chart();		
	}); 
	$('#profit_margin,#sales_discount').on('blur',function(){
		prod_sales_cost_cal();
		profit_chart();
	});
	$('#sales_target,#sales_cash,#sales_achieved,#doubtful_crsale').on('blur',function(){
		sales_particular_cal();
		profit_chart();
	});
	$('#nxt0').on('click',function(){
		/* $.ajax({
			type:'POST',
			url:'updateexp.php',
			dataType:'json'		
		})
		.done(function(res){			
			$('#tab0').slideUp('slow');
			$('#tab1').slideDown('slow');						
		}); */
		$('#tab0').slideUp('slow');
		$('#tab1').slideDown('slow');
		
	});
	$('#prev0').on('click',function(){
		$('#tab1').slideUp('slow');
		$('#tab0').slideDown('slow');
	});
	$('#nxt1').on('click',function(){		
		if($('#username').val() != '' && $('#profession').val() != '' && $('#proposed_activity').val() != '' && $('#manufacture_details').val() != '' && $('#rawmaterial_details').val() != '' && $('#sales_startegy').val() != '' && $('#manufacture_process').val() != '' && $("input:radio[name='industry_type']").is(":checked") && $("input:radio[name='proposed_size']").is(":checked") && $("input:radio[name='constitution']").is(":checked"))
		{ 
			// Serialize the form data.
			var formData = $('#reg').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){				
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 {	 */	
					epc_calc();
					$('#tab1').slideUp('slow');
					$('#tab2').slideDown('slow');
				/* 	
				 } */				
			});			
		}
		else
		{
			alert('Enter all the required fields');
		}  
	});
	$('#prev1').on('click',function(){		
		$('#tab2').slideUp('slow');
		$('#tab1').slideDown('slow');
	});
	
	$('#nxt2').on('click',function(){
		var valid=1;
		$('#tab2 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
		
		
		/* if($('#estimate_cost').val() != '' && $('#estimate_cost').val() != '0' && $('#licensing_fee').val() != '' )
		{ */	
			calc_2();
			epc_calc();
			calc_2();	
			
			// Serialize the form data.
			var formData = $('#cost').serialize();
			var URL = 'updatecost.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */
					 debt_chart();
					$('#tab2').slideUp('slow');
					$('#tab3').slideDown('slow');
				 /* } */				
			});
			
		}
		/* else
		{
			alert('Enter Approximate Project Cost');
		}  */
	});
	$('#prev2').on('click',function(){
		epc_calc();
		$('#tab3').slideUp('slow');
		$('#tab2').slideDown('slow');
	});
	
	$('#nxt3').on('click',function(){		
		/* if($('#promoter_stake').val() != '' && $('#termloan_nom').val() != '' && $('#termloan_interest').val() != '' )
		{ */
		var valid=1;
		$('#tab3 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			// Serialize the form data.
			var formData = $('#mfin').serialize();
			var URL = 'updatecost.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */
					profit_chart();
					prod_cost_chart();
					$('#tab3').slideUp('slow');
					$('#tab4').slideDown('slow');
				 /* } */				
			});
			
		}
		/* else
		{
			alert('Enter all the field');
		}  */
	});
	$('#prev3').on('click',function(){
		$('#tab4').slideUp('slow');
		$('#tab3').slideDown('slow');
	});
	$('#nxt4').on('click',function(){		
		/* if($('#installed_capacity').val() != '' && $('#capacity_utiliz').val() != '' && $('#nofday_perprod').val() != '' && $('#work_in_progress').val() != '' && $('#finishedprod_wip').val() != '' )
		{ */	
		var valid=1;
		$('#tab4 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			// Serialize the form data.
			var formData = $('#prodparam').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */
					$('#tab4').slideUp('slow');
					$('#tab5').slideDown('slow');
				 /* } */				
			});
			
		}
		/* else
		{
			alert('Enter all the fields');
		}  */
	});
	$('#prev4').on('click',function(){
		$('#tab5').slideUp('slow');
		$('#tab4').slideDown('slow');
	});
	
	$('#nxt5').on('click',function(){
		var chk=0;var vp={};
		for(var i=1;i<=5;i++)
		{
			if($('#r1c'+i).val() != '')
			{
				var cate=$('#r1c'+i).attr('data-cate');
				var mp=$('#r1c'+i).val();
				var ms=$('#r2c'+i).val();
				var wc=$('#r5c'+i).val();
				var inc = $('#r7c'+i).val();
				var bonus = $('#r9c'+i).val();		
				vp[i]=[mp,ms,wc,inc,bonus,cate];					
				chk=1;
			}
		}	
		var valid=1;
		$('#tab5 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
		/* if(parseInt(chk) > 0)
		{ */
			$.ajax({
				type:'POST',
				url:'manpower.php',
				data: {data: vp},
				success:function(res){
					profit_chart();
					$('#tab5').slideUp('slow');
					$('#tab6').slideDown('slow');					
				}
			});				
		}
		/* else
		{
			alert('Enter all the fields');
		} */
	});

	$('#prev5').on('click',function(){
		$('#tab6').slideUp('slow');
		$('#tab5').slideDown('slow');
	});
	$('#nxt6').on('click',function(){		
		/* if($('#rawmaterial').val() != '' && $('#finishedgoods').val() != '' )
		{ */	
		var valid=1;
		$('#tab6 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			// Serialize the form data.
			var formData = $('#inventory').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){				
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */	
					profit_chart();directcost_cal();
					$('#tab6').slideUp('slow');
					$('#tab7').slideDown('slow');
				 /* } */				
			});
			
		}
		/* else
		{
			alert('Enter all the fields');
		}  */
	});

	$('#prev6').on('click',function(){
		$('#tab7').slideUp('slow');
		$('#tab6').slideDown('slow');
	});
	
	$('#nxt7').on('click',function(){		
		/* if($('#power').val() != ''  && $('#water').val() != '' && $('#training').val() != '' && $('#transport').val() != '')
		{ */	
		var valid=1;
		$('#tab7 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			// Serialize the form data.
			var formData = $('#dcfrm').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				/*  if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */profit_chart();indirectcost_cal();
					$('#tab7').slideUp('slow');
					$('#tab8').slideDown('slow');
				 /* } */				
			});
			
		}
		/* else
		{
			alert('Enter all the fields');
		}  */
	});
	
	$('#prev7').on('click',function(){
		$('#tab8').slideUp('slow');
		$('#tab7').slideDown('slow');
	});
	
	$('#nxt8').on('click',function(){			
		/* if($(".indc").val() != '')
		{ */
		var valid=1;
		$('#tab8 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			// Serialize the form data.
			var formData = $('#indcfrm').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if (!res.success) {
					 alert(res.errors);
				 }
				 else
				 { */
					req_working_capital();
					req_work_capital_chart();
					$('#tab8').slideUp('slow');
					$('#tab9').slideDown('slow');
				 /*} */				
			});			
		}
		/* else
		{
			alert('Enter all the fields');
		}  */
	});
	$('#prev8').on('click',function(){
		$('#tab9').slideUp('slow');
		$('#tab8').slideDown('slow');
	}); 
	$('#nxt9').on('click',function(){
		profit_chart();
		deposit_cal();
		$('#tab9').slideUp('slow');
		$('#tab10').slideDown('slow');
	});
	$('#prev9').on('click',function(){
		$('#tab10').slideUp('slow');
		$('#tab9').slideDown('slow');
	});
	$('#nxt10').on('click',function(){
		// Serialize the form data.
		var valid=1;
		$('#tab10 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			var formData = $('#findep').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */				
					sale_mark_cal();
					distri_chart();
					
					profit_chart();
					$('#tab10').slideUp('slow');
					$('#tab11').slideDown('slow');
				/*  } */				
			});	
		}		
		
	});
	$('#prev10').on('click',function(){
		$('#tab11').slideUp('slow');
		$('#tab10').slideDown('slow');
	});
	$('#nxt11').on('click',function(){
		profit_chart();
		$('#tab11').slideUp('slow');
		$('#tab12').slideDown('slow');
	});
	$('#prev11').on('click',function(){
		$('#tab12').slideUp('slow');
		$('#tab11').slideDown('slow');
	});
	
	$('#nxt12').on('click',function(){
		// Serialize the form data.
		var valid=1;
		$('#tab12 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			var formData = $('#prodsalescost').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */profit_chart();
					$('#tab12').slideUp('slow');
					$('#tab13').slideDown('slow');
				 /* } */				
			});	
		}		
		
	});
	$('#prev12').on('click',function(){
		$('#tab13').slideUp('slow');
		$('#tab12').slideDown('slow');
	});
	
	
	$('#nxt13').on('click',function(){
		// Serialize the form data.
		var valid=1;
		$('#tab13 .reqtext').each(function(){
			if($(this).val() == '')
			{
				valid=0;
			}				
		});		
		if(parseInt(valid) == 0)
		{
			alert('Enter all the required fields');
		}
		else
		{
			var formData = $('#salesparticular').serialize();
			var URL = 'process.php';
			$.ajax({
				type:'POST',
				url:URL,
				data:formData,
				dataType:'json'			
			})
			.done(function(res){
				 /* if ( ! res.success) {
					 alert(res.errors);
				 }
				 else
				 { */
					 revenue_cal();profit_chart();
					$('#tab13').slideUp('slow');
					$('#tab14').slideDown('slow');
				 /* } */				
			});	
		}		
		
	});
	$('#prev13').on('click',function(){
		$('#tab14').slideUp('slow');
		$('#tab13').slideDown('slow');
	});
	$('#nxt14').on('click',function(){
		cashflow_cal();
		profit_chart();
		$('#tab14').slideUp('slow');
		$('#tab15').slideDown('slow');
	});
	$('#prev14').on('click',function(){
		$('#tab15').slideUp('slow');
		$('#tab14').slideDown('slow');
	});
	$('#nxt15').on('click',function(){
		$.ajax({
			type:'POST',
			url:'updatestatus.php',
			dataType:'json'		
		})
		.done(function(res){			
			window.location.href="viewall.php";							
		});		
	});
	
});  
setTimeout( "$('.outputs,.outputf').hide();", 4000);