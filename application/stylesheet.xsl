<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:exsl="http://exslt.org/common" xmlns:dyn="http://exslt.org/dynamic" extension-element-prefixes="exsl">
	<!-- <xsl:import href="exsl.xsl" /> -->

	<xsl:output method="html" version="1.0" encoding="utf-8" indent="yes" />

	<xsl:template match="*"/>

	<xsl:template match="/xs:schema">

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
			<xsl:apply-templates select="xs:complexType"/>
			<xsl:apply-templates/>

			<xsl:element name="input">
				<xsl:attribute name="type">submit</xsl:attribute>
				<xsl:attribute name="value">Send</xsl:attribute>
			</xsl:element>
		</xsl:element>
	</xsl:template>

	<xsl:template match="xs:element[xs:simpleType]">
		<xsl:element name="fieldset">
			<xsl:element name="legend">
				<xsl:value-of select="@name"/>
			</xsl:element>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>

	<xsl:template name="handle-enumerations">
		<xsl:param name="default" />
		<xsl:param name="disabled">false</xsl:param>
		
		<xsl:variable name="type">
			<xsl:call-template name="get-type"/>
		</xsl:variable>
		
		<xsl:variable name="type-suffix">
			<xsl:call-template name="get-suffix">
				<xsl:with-param name="string" select="$type" />
			</xsl:call-template>
		</xsl:variable>
		
		<xsl:variable name="namespace-documents">
			<xsl:call-template name="get-my-namespace-documents" />
		</xsl:variable>
		
		<xsl:apply-templates select=".//xs:restriction/xs:enumeration" mode="input">
			<xsl:with-param name="default" select="$default" />
			<xsl:with-param name="disabled" select="$disabled" />
		</xsl:apply-templates>
		
		<xsl:for-each select="exsl:node-set($namespace-documents)//xs:simpleType[@name=$type-suffix]">
			<xsl:call-template name="handle-enumerations">
				<xsl:with-param name="default" select="$default" />
				<xsl:with-param name="disabled" select="$disabled" />
			</xsl:call-template>
		</xsl:for-each>
	</xsl:template>

	<xsl:template name="prueba" match="xs:complexType">
		<xsl:element name="fieldset">
			<xsl:element name="legend">
				<xsl:value-of select="substring-after(@name,'.')"/>
			</xsl:element>
			<xsl:apply-templates/>
		</xsl:element>
		<!-- <xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value"><xsl:value-of select="substring-after(@name,'.')"/></xsl:attribute>
		</xsl:element> -->

		<!-- Choice Button prueba -->
		<!-- <xsl:if test="not($choice = '')">
			<xsl:call-template name="add-choice-button">
				<xsl:with-param name="name" select="$choice" />
				<xsl:with-param name="disabled">false</xsl:with-param>
			</xsl:call-template>
		</xsl:if> -->
	</xsl:template>

	<xsl:template match="xs:complexType//xs:sequence">
		<xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value"><xsl:value-of select="substring-after(@name,'.')"/></xsl:attribute>
		</xsl:element>
	</xsl:template>

	<xsl:template match="xs:sequence">

		<!-- <xsl:param name="tree" />
		<xsl:param name="disabled">false</xsl:param>

		<xsl:apply-templates select="xs:element|xs:attribute|xs:group|xs:choice|xs:sequence"/> -->
	</xsl:template>





	<xsl:template match="xs:element[@type]">
		<xsl:param name="root-namespaces" /> <!-- contains root document's namespaces and prefixes -->
		<xsl:param name="namespace-prefix" /> <!-- contains inherited namespace prefix -->
		<xsl:param name="choice" /> <!-- handles xs:choice elements and descendants; contains a unique ID for radio buttons of the same group to share -->
		<xsl:param name="disabled">false</xsl:param> <!-- is used to disable elements that are copies for additional occurrences -->
		<xsl:param name="tree" /> <!-- contains an XPath query relative to the current node, to be used with 'xml-doc' -->
		<xsl:param name="min-occurs" />
		<xsl:param name="max-occurs" />

		<xsl:variable name="type">
			<xsl:value-of select="@type" />
		</xsl:variable>

		<xsl:variable name="type-suffix">
			<xsl:call-template name="get-suffix">
				<xsl:with-param name="string" select="$type"/>
			</xsl:call-template>
		</xsl:variable>

		<xsl:variable name="namespace-documents">
			<xsl:call-template name="get-my-namespace-documents" />
		</xsl:variable>

		<xsl:choose>
			<xsl:when test="exsl:node-set($namespace-documents)//xs:complexType[@name=$type-suffix]/xs:simpleContent">
				<xsl:call-template name="handle-complex-elements">
					<xsl:with-param name="root-namespaces" select="$root-namespaces" />
					<xsl:with-param name="namespace-prefix" select="$namespace-prefix" />
					<xsl:with-param name="simple">true</xsl:with-param>
					<xsl:with-param name="choice" select="$choice"/>
					<xsl:with-param name="disabled" select="$disabled" />
					<xsl:with-param name="tree" select="$tree" />
					<xsl:with-param name="min-occurs" select="$min-occurs" />
					<xsl:with-param name="max-occurs" select="$max-occurs" />
				</xsl:call-template>
			</xsl:when>
		</xsl:choose>



		<!-- <xsl:element name="input">
			<xsl:attribute name="type">button</xsl:attribute>
			<xsl:attribute name="value">
				<xsl:value-of select="$type-suffix"/>
			</xsl:attribute>
		</xsl:element> -->
	</xsl:template>

	<xsl:template name="handle-complex-elements" match="xs:element[xs:complexType/*[not(self::xs:simpleContent)]]">
		<xsl:element name="h6">
			<xsl:attribute name="text">jasjahs</xsl:attribute>
		</xsl:element>
		
	</xsl:template>

	<xsl:template name="get-suffix">
		<xsl:param name="string"/>

		<xsl:choose>
			<xsl:when test="contains($string, ':')">
				<xsl:value-of select="substring-after($string, ':')" />
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$string" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<!-- <xsl:template match="xs:simpleType">

	</xsl:template>


	<xsl:template match="xs:enumeration" mode="input">
		<xsl:param name="default" />
		<xsl:param name="disabled" />
		
		<xsl:variable name="description">
			<xsl:call-template name="get-description" />
		</xsl:variable>
		
		<xsl:element name="option">
			<xsl:if test="$default = @value">
				<xsl:attribute name="selected">selected</xsl:attribute>
			</xsl:if>
			
			<xsl:if test="$disabled = 'true' and not($default = @value)">
				<xsl:attribute name="disabled">disabled</xsl:attribute>
			</xsl:if>
			
			<xsl:attribute name="value">
				<xsl:value-of select="@value"/>
			</xsl:attribute>
			
			<xsl:value-of select="$description"/>
		</xsl:element>
	</xsl:template>

	<xsl:template name="add-hl7-selector-element">
		<xsl:param name="name"/>
		<xsl:param name="description"/>
		<xsl:param name="disabled">false</xsl:param>

		<xsl:element name="div">
			<xsl:attribute name="class">dropdown</xsl:attribute>
			<xsl:element name="input">
				<xsl:attribute name="type">text</xsl:attribute>
				<xsl:attribute name="class">droptxt</xsl:attribute>
				<xsl:attribute name="name">
					<xsl:value-of select="$name"/>
				</xsl:attribute>
			</xsl:element>

			<xsl:element name="div">
				<xsl:attribute name="class">dropdown-content</xsl:attribute>
				<xsl:for-each select="//xs:enumeration">
					
				</xsl:for-each>
			</xsl:element>
		</xsl:element>
	</xsl:template>-->

	<!-- adds a radio button for choice groups -->
	<xsl:template name="add-choice-button">
		<xsl:param name="name" />
		<xsl:param name="description" />
		<xsl:param name="disabled">false</xsl:param>
		
		<xsl:element name="label">
			<xsl:if test="not($config-label-after-input = 'true')">
				<xsl:element name="span">
					<!-- <xsl:value-of select="$description" /> -->
					ashabjh
				</xsl:element>
			</xsl:if>
		
			<xsl:element name="input">
				<xsl:attribute name="type">radio</xsl:attribute>
				<xsl:attribute name="name">
					<xsl:value-of select="$name"/>
				</xsl:attribute>
				<xsl:attribute name="required">required</xsl:attribute>
				<xsl:if test="$disabled = 'true'">
					<xsl:attribute name="disabled">disabled</xsl:attribute>
				</xsl:if>
				<xsl:attribute name="onclick">clickRadioInput(this, '<xsl:value-of select="$name" />');</xsl:attribute>
			</xsl:element>
			
			<!-- <xsl:if test="$config-label-after-input = 'true'">
				<xsl:element name="span">
					<xsl:value-of select="$description" />
				</xsl:element>
			</xsl:if> -->
		</xsl:element>
	</xsl:template>
</xsl:stylesheet>