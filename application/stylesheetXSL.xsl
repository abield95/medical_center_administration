<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:exsl="http://exslt.org/common" xmlns:dyn="http://exslt.org/dynamic" extension-element-prefixes="exsl">
	<!-- <xsl:import href="exsl.xsl" /> -->
	<!-- <xsl:strip-space elements="*" /> -->

	<xsl:output method="html" omit-xml-declaration="yes" encoding="utf-8" indent="yes" />

	
	<xsl:variable name="config-label-after-input">false</xsl:variable>

	<!-- optionally specify which annotation/documentation language (determined by xml:lang) should be used -->
	<xsl:variable name="config-language" />
	
	<!-- optionally specify text for interactive elements -->
	<xsl:variable name="config-add-button-label">+</xsl:variable>
	<xsl:variable name="config-remove-button-label">-</xsl:variable>
	<xsl:variable name="config-submit-button-label">OK</xsl:variable>
	<xsl:variable name="config-seconds">seconds</xsl:variable>
	<xsl:variable name="config-minutes">minutes</xsl:variable>
	<xsl:variable name="config-hours">hours</xsl:variable>
	<xsl:variable name="config-days">days</xsl:variable>
	<xsl:variable name="config-months">months</xsl:variable>
	<xsl:variable name="config-years">years</xsl:variable>
	
	<!-- optionally specify the xml document to populate the form with -->
	<!-- <xsl:variable name="xml-doc">
		<xsl:copy-of select="document('examples/complex-sample.xml')/*"/>
	</xsl:variable> -->
	<xsl:variable name="xml-doc" />

	<xsl:template match="*"/>
	
	<!-- root match from which all other templates are invoked -->
	<xsl:template match="/xs:schema">
		<!-- load xml-doc as nodeset for future use -->
		<xsl:message><xsl:value-of select="exsl:node-set($xml-doc)/*" /></xsl:message>

		<!-- load root-namespaces for future use-->
		<xsl:variable name="root-namespace">
			<xsl:for-each select="namespace::*">
				<xsl:if test="not(name() = '')">
					<xsl:attribute name="prefix">
						<xsl:value-of select="name()"/>
						<xsl:text>:</xsl:text>
					</xsl:attribute>
				</xsl:if>

				<xsl:attribute name="namespace">
					<xsl:value-of select="."/>
				</xsl:attribute>
			</xsl:for-each>
		</xsl:variable>

		<xsl:element name="form">

			<!--start parsing from the top-->
			<!-- <xsl:apply-templates select="xs:element">
				<xsl:with-param name="root-namepaces" select="$root-namespaces" />
			</xsl:apply-templates> -->
			<xsl:apply-templates select="xs:element">
				<xsl:with-param name="root-namespace" select="$root-namespace" />
			</xsl:apply-templates>
			<!-- <xsl:apply-templates/> -->

			<xsl:element name="input">
				<xsl:attribute name="type">submit</xsl:attribute>
				<xsl:attribute name="value">Send</xsl:attribute>
			</xsl:element>
		</xsl:element>
	</xsl:template>

	<xsl:template match="xs:element[@type]">
		
		<xsl:variable name="type"><xsl:value-of select="@type"/></xsl:variable>
		<xsl:variable name="type-suffix">
			<xsl:call-template name="get-suffix">
				<xsl:with-param name="string" select="$type" />
			</xsl:call-template>
		</xsl:variable>
		<xsl:apply-templates select="xs:simpleType"/>
		<!-- <xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value">jajhsjahs</xsl:attribute>
		</xsl:element> -->
		<!-- <xsl:choose>
			<xsl:when test="//xs:simpleType[@name=$type-suffix]">
				<xsl:apply-templates select="xs:simpleType"/>
			</xsl:when>
		</xsl:choose> -->
	</xsl:template>
	
	

	<!-- <xsl:template match="xs:simpleType">
		<xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value">12</xsl:attribute>
		</xsl:element>
	</xsl:template> --> 
	<xsl:template name="handle-simple-elements" match="xs:simpleType">
		<xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value">12</xsl:attribute>
		</xsl:element>
	</xsl:template>

	<xsl:template match="xs:simpleType//xs:restriction">
		<xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value">01</xsl:attribute>
		</xsl:element>
	</xsl:template>

	<xsl:template name="get-suffix">
		<xsl:param name="string" />

		<xsl:choose>
			<xsl:when test="contains($string, ':')">
				<xsl:value-of select="substring-after($string, ':')" />
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$string" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>

</xsl:stylesheet>