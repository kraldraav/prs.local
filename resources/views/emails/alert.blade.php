<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="Александр Шилин">
	<META NAME="CREATED" CONTENT="20181116;130600000000000">
	<META NAME="CHANGEDBY" CONTENT="Евгений Хомутов">
	<META NAME="CHANGED" CONTENT="20181120;132100000000000">
	<META NAME="AppVersion" CONTENT="12.0000">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-left: 0.89in; margin-right: 0.59in; margin-top: 0.19in; margin-bottom: 0.49in }
		P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
	-->
	</STYLE>
</HEAD>
<BODY LANG="ru-RU" DIR="LTR">
<DIV TYPE=HEADER>
	<P ALIGN=CENTER STYLE="margin-bottom: 0.56in; line-height: 100%"><IMG SRC="Template_Alert_html_b4ef34cf.jpg" NAME="Picture 0" ALIGN=BOTTOM WIDTH=652 HEIGHT=133 BORDER=0></P>
</DIV>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 150%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4><U><B>Внимание!</B></U></FONT></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=4><B>Требуется
оперативно осуществить закупку картриджей
согласно прилагаемому списку:</B></FONT></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in">
<TABLE WIDTH=659 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=172>
	<COL WIDTH=254>
	<COL WIDTH=189>
	<TR>
		<TD WIDTH=172 HEIGHT=14 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>Наименование
			картриджа</B></FONT></FONT></P>
		</TD>
		<TD WIDTH=254 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>Текущий
			остаток</B></FONT></FONT></P>
		</TD>
		<TD WIDTH=189 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>Рекомендуется
			приобрести</B></FONT></FONT></P>
		</TD>
	</TR>
        @foreach($cartridges as $cartridge)
	<TR>
		<TD WIDTH=172 HEIGHT=14 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P><FONT FACE="Times New Roman, serif"><FONT SIZE=3><SPAN LANG="en-US">{{$cartridge->cartridge_name}}</SPAN></FONT></FONT></P>
		</TD>
		<TD WIDTH=254 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=3><SPAN LANG="en-US">{{$cartridge->count}}</SPAN></FONT></FONT></P>
		</TD>
		<TD WIDTH=189 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P LANG="en-US"><?php  
                        $count = $cartridge->count;
                        $threshold = $cartridge->threshold;
                        echo $threshold-$count;
                        ?>
			</P>
		</TD>
	</TR>
        @endforeach
</TABLE>
</P>
<P STYLE="margin-left: -0.2in; margin-bottom: 0.14in"><BR><BR>
</P>
<TABLE WIDTH=654 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=197>
	<COL WIDTH=108>
	<COL WIDTH=114>
	<COL WIDTH=179>
	<TR>
		<TD COLSPAN=3 WIDTH=447 VALIGN=TOP STYLE="border: none; padding: 0in">
			<P STYLE="margin-bottom: 0in"><BR>
			</P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>С
			Уважением,</B></FONT></FONT></P>
			<P STYLE="margin-bottom: 0in"><BR>
			</P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Система
			Учета Расходных Материалов АО ТГК
			«Вега»</FONT></FONT></P>
			<P><BR>
			</P>
		</TD>
		<TD WIDTH=179 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
			</P>
			<P ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=197 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P LANG="en-US" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=108 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P LANG="en-US"><BR>
			</P>
		</TD>
		<TD WIDTH=114 VALIGN=TOP STYLE="border: none; padding: 0in">
			<P STYLE="margin-bottom: 0in"><BR>
			</P>
			<P><BR>
			</P>
		</TD>
		<TD WIDTH=179 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-left: 0.03in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3><SPAN LANG="en-US"><?php echo date('Y-m-d H:i'); ?></SPAN></FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=197 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=108 VALIGN=TOP STYLE="border: none; padding: 0in">
			<P STYLE="margin-left: 0.21in"><BR>
			</P>
		</TD>
		<TD WIDTH=114 VALIGN=TOP STYLE="border: none; padding: 0in">
			<P><BR>
			</P>
		</TD>
		<TD WIDTH=179 VALIGN=BOTTOM STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P STYLE="margin-left: 0.61in">     <FONT FACE="Times New Roman, serif"><FONT SIZE=3>Дата</FONT></FONT></P>
		</TD>
	</TR>
</TABLE>
<P STYLE="margin-left: -0.2in; margin-bottom: 0.14in"><BR><BR>
</P>
<DIV TYPE=FOOTER>
	<P ALIGN=CENTER STYLE="margin-left: -0.2in; text-indent: -0.1in; margin-top: 0.26in; margin-bottom: 0in; line-height: 100%">
	<IMG SRC="Template_Alert_html_8faf1b09.jpg" NAME="Рисунок 3" ALIGN=BOTTOM WIDTH=679 HEIGHT=109 BORDER=0></P>
</DIV>
</BODY>
</HTML>