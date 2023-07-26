<!-- NAME: SELL PRODUCTS -->
<!--[if gte mso 15]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>3DS triển khai đơn hàng {{$donHang->ma_don_hang}}</title>
        
        <style type="text/css">
            * {
                font-family: Helvetica;
            }
            
            p {
                margin: 10px 0;
                padding: 0;
            }
            
            table {
                border-collapse: collapse;
            }
            
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                display: block;
                margin: 0;
                padding: 0;
            }
            
            img,
            a img {
                border: 0;
                height: auto;
                outline: none;
                text-decoration: none;
            }
            
            body,
            #bodyTable,
            #bodyCell {
                height: 100%;
                margin: 0;
                padding: 0;
                width: 100%;
            }
            
            .table_sp,
            .th_sp,
            .td_sp {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 3px;
                font-family: Helvetica;
            }
            
            .mcnPreviewText {
                display: none !important;
            }
            
            #outlook a {
                padding: 0;
            }
            
            img {
                -ms-interpolation-mode: bicubic;
            }
            
            table {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            
            .ReadMsgBody {
                width: 100%;
            }
            
            .ExternalClass {
                width: 100%;
            }
            
            p,
            a,
            li,
            td,
            blockquote {
                mso-line-height-rule: exactly;
            }
            
            a[href^=tel],
            a[href^=sms] {
                color: inherit;
                cursor: default;
                text-decoration: none;
            }
            
            p,
            a,
            li,
            td,
            body,
            table,
            blockquote {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
            
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass td,
            .ExternalClass div,
            .ExternalClass span,
            .ExternalClass font {
                line-height: 100%;
            }
            
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            
            .templateContainer {
                max-width: 600px !important;
            }
            
            a.mcnButton {
                display: block;
            }
            
            .mcnImage,
            .mcnRetinaImage {
                vertical-align: bottom;
            }
            
            .mcnTextContent {
                word-break: break-word;
            }
            
            .mcnTextContent img {
                height: auto !important;
            }
            
            .mcnDividerBlock {
                table-layout: fixed !important;
            }
            
            h1 {
                color: #222222;
                font-family: Helvetica;
                font-size: 40px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: center;
            }
            
            h2 {
                color: #222222;
                font-family: Helvetica;
                font-size: 34px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: left;
            }
            
            h3 {
                color: #444444;
                font-family: Helvetica;
                font-size: 22px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: left;
            }
            
            h4 {
                color: #949494;
                font-family: Georgia;
                font-size: 20px;
                font-style: italic;
                font-weight: normal;
                line-height: 125%;
                letter-spacing: normal;
                text-align: left;
            }
            
            #templateHeader {
                background-color: #transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .headerContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .headerContainer .mcnTextContent,
            .headerContainer .mcnTextContent p {
                color: #757575;
                font-family: Helvetica;
                font-size: 16px;
                line-height: 150%;
                text-align: left;
            }
            
            .headerContainer .mcnTextContent a,
            .headerContainer .mcnTextContent p a {
                color: #007C89;
                font-weight: normal;
                text-decoration: underline;
            }
            
            #templateBody {
                background-color: #ccc;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .bodyContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .bodyContainer .mcnTextContent,
            .bodyContainer .mcnTextContent p {
                color: #757575;
                font-family: Helvetica;
                font-size: 16px;
                line-height: 150%;
                text-align: left;
            }
            
            .bodyContainer .mcnTextContent a,
            .bodyContainer .mcnTextContent p a {
                color: #007C89;
                font-weight: normal;
                text-decoration: underline;
            }
            
            #templateFooter {
                background-color: #fff;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .footerContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .footerContainer .mcnTextContent,
            .footerContainer .mcnTextContent p {
                color: #FFFFFF;
                font-family: Helvetica;
                font-size: 12px;
                line-height: 150%;
                text-align: center;
            }
            
            .footerContainer .mcnTextContent a,
            .footerContainer .mcnTextContent p a {
                color: #FFFFFF;
                font-weight: normal;
                text-decoration: underline;
            }
            
            @media only screen and (min-width:768px) {
                .templateContainer {
                    width: 600px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                body,
                table,
                td,
                p,
                a,
                li,
                blockquote {
                    -webkit-text-size-adjust: none !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                body {
                    width: 100% !important;
                    min-width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnRetinaImage {
                    max-width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImage {
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnCartContainer,
                .mcnCaptionTopContent,
                .mcnRecContentContainer,
                .mcnCaptionBottomContent,
                .mcnTextContentContainer,
                .mcnBoxedTextContentContainer,
                .mcnImageGroupContentContainer,
                .mcnCaptionLeftTextContentContainer,
                .mcnCaptionRightTextContentContainer,
                .mcnCaptionLeftImageContentContainer,
                .mcnCaptionRightImageContentContainer,
                .mcnImageCardLeftTextContentContainer,
                .mcnImageCardRightTextContentContainer,
                .mcnImageCardLeftImageContentContainer,
                .mcnImageCardRightImageContentContainer {
                    max-width: 100% !important;
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnBoxedTextContentContainer {
                    min-width: 100% !important;
                }
                #templateBody {
                    background-color: #FFFFFF !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupContent {
                    padding: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnCaptionLeftContentOuter .mcnTextContent,
                .mcnCaptionRightContentOuter .mcnTextContent {
                    padding-top: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardTopImageContent,
                .mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,
                .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
                    padding-top: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardBottomImageContent {
                    padding-bottom: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupBlockInner {
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupBlockOuter {
                    padding-top: 9px !important;
                    padding-bottom: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnTextContent,
                .mcnBoxedTextContentColumn {
                    padding-right: 18px !important;
                    padding-left: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardLeftImageContent,
                .mcnImageCardRightImageContent {
                    padding-right: 18px !important;
                    padding-bottom: 0 !important;
                    padding-left: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcpreview-image-uploader {
                    display: none !important;
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h1 {
                    font-size: 30px !important;
                    line-height: 125% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h2 {
                    font-size: 26px !important;
                    line-height: 125% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h3 {
                    font-size: 20px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h4 {
                    font-size: 18px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnBoxedTextContentContainer .mcnTextContent,
                .mcnBoxedTextContentContainer .mcnTextContent p {
                    font-size: 14px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .headerContainer .mcnTextContent,
                .headerContainer .mcnTextContent p {
                    font-size: 16px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .bodyContainer .mcnTextContent,
                .bodyContainer .mcnTextContent p {
                    font-size: 16px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .footerContainer .mcnTextContent,
                .footerContainer .mcnTextContent p {
                    font-size: 14px !important;
                    line-height: 150% !important;
                }
            }
        </style>
        
        <!--
                                                        -->
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;">
                <tbody>
                    <tr>
                        <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;">
                            <!-- BEGIN TEMPLATE // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody>
        
                                    <tr>
                                        <td align="center" valign="top" id="templateBody" data-template-container="" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 0px;padding:20px 0px;background-color: #ccc;">
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                                                            <tr>
                                                                                            <td align="center" valign="top" width="600" style="width:600px;">
                                                                                            <![endif]-->
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;background-color: #fff;">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnImageBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                                                                            <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="mcnImageContent" valign="top" style="padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
        
                                                                                            <a href="https://3d-smartsolutions.com/gioi-thieu-cong-ty-3d-smart-solutions/" title="" class="" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                <img align="center" alt="" src="https://drive.3d-smartsolutions.com/tai-ve/6c148dc6892a9926fb3017d803d7d0a3d85f1ace1e1a71967b9e9bf12d4659fc" width="600" style="max-width: 1000px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                    class="mcnImage">
                                                                                            </a>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnTextBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                        <tr>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        <td valign="top" width="600" style="width:600px;">
                                                                        <![endif]-->
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                                                                <tbody>
                                                                                    <tr>
        
                                                                                        <td valign="top" class="mcnTextContent" style="padding: 30px 36px 0px 36px;line-height: 150%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #757575;font-family: Helvetica;font-size: 16px;text-align: left;">
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 0px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;text-align: right;">[English below]</p>
                                                                                            <h3 style="text-align: justify;display: block;margin: 0;padding: 0;color: #444444;font-family: Helvetica;font-size: 22px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;">Kính gửi {{$tenCongTy}}</h3>
        
        
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Cảm ơn Quý Khách hàng đã tin tưởng hợp tác.Công ty
                                                                                                <a href="https://3d-smartsolutions.com" target="_blank" title="3D Smart Solutions Co., Ltd." style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #007C89;font-weight: normal;text-decoration: underline;"><span style="color:#b81717"><strong>3D Smart Solutions (3DS)</strong></span></a>
                                                                                                xin được phép thực hiện hợp đồng / Đơn hàng của quý khách. Theo các thông tin như sau:</p>
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;"><span style="background-color: transparent; text-align: left;">
                                                                                                                                                <ol>
                                                                                                                                                    <li> Mã số đơn hàng: <strong>{{$donHang->ma_don_hang}}</strong> </li>
                                                                                                                                                    <li> Giá trị đơn hàng: {{number_format($donHang->doanh_thu)}} VND</li>
                                                                                                                                                    <li > Nội dung đơn hàng gồm có như sau<br><br>
                                                                                                                                                        <span style="font-size: 16px;">
                                                                                                                                                            <table style="font-size:12px;border: 1px solid black;border-collapse: collapse;padding: 3px;font-family: Helvetica;color: #757575;" class="table_sp" >
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;font-family: Helvetica;color: #757575;">
                                                                                                                                                                    <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;font-family: Helvetica;color: #757575;">Tên SP</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">SL</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">Giá sản phẩm</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">VAT (%)</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">CK (%)</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">Thành tiền</th>
                                                                                                                                                                     
                                                                                                                                                                </tr>
                                                                                                                                                                @foreach($donHang->sanPhams as $sanPham)
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">
                                                                                                                                                                    <td class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;">{{$sanPham->danhMucSanPham->ten_san_pham}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->so_luong}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{number_format($sanPham->gia_san_pham)}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->ti_le_vat}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->ti_le_chiet_khau}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{number_format($sanPham->gia_ban_khong_vat+($sanPham->gia_ban_khong_vat*$sanPham->ti_le_vat/100) - ( $sanPham->gia_ban_khong_vat * $sanPham->ti_le_chiet_khau / 100) )}}</td>
                                                                                                                                                                </tr>
                                                                                                                                                                @endforeach
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">
                                                                                                                                                                    <td class="td_sp" colspan="5" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;"><strong>Tổng</strong> </td>
                                                                                                                                                                    <td style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;" class="td_sp">{{number_format($donHang->doanh_thu)}}</td>
                                                                                                                                                                </tr>
                                                                                                                                                                
                                                                                                                                                                
                                                                                                                                                            </table>
                                                                                                                                                        </span>
                                                                                                </li>
                                                                                                </ol>
                                                                                                </span>
                                                                                            </p>
        
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Bất cứ lúc nào nếu quý khách có câu hỏi hoặc thắc mắc - Quý khách xin vui lòng liên hệ ngay với chúng tôi:
                                                                                                <ul>
                                                                                                    <li>Phụ trách kinh doanh: <strong>{{$donHang->nhanVien->user->name}}</strong> | {{($donHang->nhanVien->sdt != null ? $donHang->nhanVien->sdt:'chưa cập nhật' )}} |
                                                                                                        <a href="mailto:{{$donHang->nhanVien->user->email}}">{{$donHang->nhanVien->user->email}}</a>
                                                                                                    </li>
                                                                                                    <li>Phụ trách lắp đặt, đào tạo hướng dẫn sử dụng:<br> Tel.
                                                                                                        <a href="tel:028 888 99039">028 888 99039</a> Ext. 3006 | Email:
                                                                                                        <a href="mailto:hotrokythuat@3ds.vn">hotrokythuat@3ds.vn</a>
                                                                                                    </li>
                                                                                                    <li>Phụ trách hoá đơn, thủ tục nghiệm thu thanh lý:<br> Tel. <a href="tel:028 888 99039">028 888 99039</a> Ext. 3002 | Email:
                                                                                                        <a href="mailto:admin@3ds.vn">admin@3ds.vn</a>
                                                                                                    </li>
                                                                                                    <li>Hộp thư góp ý chất lượng dịch vụ:
                                                                                                        <a href="mailto:ceo.assistant@3ds.vn">ceo.assistant@3ds.vn</a>
                                                                                                    </li>
                                                                                                </ul>
        
                                                                                            </p>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr align="left ">
                                                                                        <td style="padding:0px 36px 30px 36px; " colspan="2">
                                                                                            <hr><br> <span style="padding:10px 0px;font-size: 14px;color: #939598;font-weight: 500;font-style: italic;font-family: Helvetica;line-height: 16px; " class="content-3ds">Đây là email được cấu hình để tự động gửi đi từ hệ thống CRM của Công Ty TNHH 3D Smart Solutions. Nhằm phục vụ cho quá trình thực hiện đơn hàng chuyên nghiệp nhất.<br> Quý khách vui lòng Reply All mỗi khi phản hồi thông tin để chúng tôi có thể phục vụ tốt nhất cho Quý Khách.</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if mso]>
                                                                        </td>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <hr>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                        <tr>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        <td valign="top" width="600" style="width:600px;">
                                                                        <![endif]-->
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                                                                <tbody>
                                                                                    <tr>
        
                                                                                        <td valign="top" class="mcnTextContent" style="padding: 30px 36px 0px 36px;line-height: 150%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #757575;font-family: Helvetica;font-size: 16px;text-align: left;">
        
                                                                                            <h3 style="text-align: justify;display: block;margin: 0;padding: 0;color: #444444;font-family: Helvetica;font-size: 22px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;">Dear {{$tenCongTy}}</h3>
        
        
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Thank you our beloved Customer for your trust and cooperation. Please allow
                                                                                                <a href="https://3d-smartsolutions.com" target="_blank" title="3D Smart Solutions Co., Ltd." style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #007C89;font-weight: normal;text-decoration: underline;"><span style="color:#b81717"><strong>3D Smart Solutions (3DS)</strong></span></a>
                                                                                                to complete your purchase order/contract with the details below:</p>
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;"><span style="background-color: transparent; text-align: left;">
                                                                                                                                                <ol>
                                                                                                                                                    <li> Order number: <strong>{{$donHang->ma_don_hang}}</strong> </li>
                                                                                                                                                    <li> Order value: {{number_format($donHang->doanh_thu)}} VNĐ</li>
                                                                                                                                                    <li > Order description:<br><br>
                                                                                                                                                        <span style="font-size: 16px;">
                                                                                                                                                            <table style="font-size:12px;border: 1px solid black;border-collapse: collapse;padding: 3px;font-family: Helvetica;color: #757575;" class="table_sp" >
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;font-family: Helvetica;color: #757575;">
                                                                                                                                                                    <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;font-family: Helvetica;color: #757575;">Product name</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">Qty</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">Unit price</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">VAT (%)</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">Discount (%)</th>
                                                                                                                                                                     <th class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;"> Amount</th>
                                                                                                                                                                     
                                                                                                                                                                </tr>
                                                                                                                                                                @foreach($donHang->sanPhams as $sanPham)
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">
                                                                                                                                                                    <td class="td_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;">{{$sanPham->danhMucSanPham->ten_san_pham}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->so_luong}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{number_format($sanPham->gia_san_pham)}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->ti_le_vat}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{$sanPham->ti_le_chiet_khau}}</td>
                                                                                                                                                                    <td class="td_sp" style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;">{{number_format($sanPham->gia_ban_khong_vat+($sanPham->gia_ban_khong_vat*$sanPham->ti_le_vat/100) - ( $sanPham->gia_ban_khong_vat * $sanPham->ti_le_chiet_khau / 100) )}}</td>
                                                                                                                                                                </tr>
                                                                                                                                                                @endforeach
                                                                                                                                                                <tr class="tr_sp" style="border: 1px solid black;border-collapse: collapse;padding: 3px;">
                                                                                                                                                                    <td class="td_sp" colspan="5" style="border: 1px solid black;border-collapse: collapse;padding: 3px;text-align: center;"><strong>Total</strong> </td>
                                                                                                                                                                    <td style="text-align: right;border: 1px solid black;border-collapse: collapse;padding: 3px;" class="td_sp">{{number_format($donHang->doanh_thu)}}</td>
                                                                                                                                                                </tr>
                                                                                                                                                                
                                                                                                                                                                
                                                                                                                                                            </table>
                                                                                                                                                        </span>
                                                                                                </li>
                                                                                                </ol>
                                                                                                </span>
                                                                                            </p>
        
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Thank you for your cooperation and don't be hesitant to reach out if you have any further questions.
                                                                                                <ul>
                                                                                                    <li>In charge of sales: <strong>{{$donHang->nhanVien->user->name}}</strong> | {{($donHang->nhanVien->sdt != null ? $donHang->nhanVien->sdt:'chưa cập nhật' )}} |
                                                                                                        <a href="mailto:{{$donHang->nhanVien->user->email}}">{{$donHang->nhanVien->user->email}}</a>
                                                                                                    </li>
                                                                                                    <li>In charge of installation, training manuals:<br> Tel.
                                                                                                        <a href="tel:028 888 99039">028 888 99039</a> Ext. 3006 | Email:
                                                                                                        <a href="mailto:hotrokythuat@3ds.vn">hotrokythuat@3ds.vn</a>
                                                                                                    </li>
                                                                                                    <li>In charge of invoices and procedures for acceptance and liquidation:<br> Tel. <a href="tel:028 888 99039">028 888 99039</a> Ext. 3002 | Email:
                                                                                                        <a href="mailto:admin@3ds.vn">admin@3ds.vn</a>
                                                                                                    </li>
                                                                                                    <li>For service-quality feedback:
                                                                                                        <a href="mailto:ceo.assistant@3ds.vn">ceo.assistant@3ds.vn</a>
                                                                                                    </li>
                                                                                                </ul>
        
                                                                                            </p>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr align="left ">
                                                                                        <td style="padding:0px 36px 30px 36px; " colspan="2">
                                                                                            <hr><br> <span style="padding:10px 0px;font-size: 14px;color: #939598;font-weight: 500;font-style: italic;font-family: Helvetica;line-height: 16px; " class="content-3ds">This email is configured to automatically send from the CRM system of 3D Smart Solutions Co., Ltd. To serve the most professional order fulfillment process successfully.<br>Please click "Reply All" whenever you give us your feedback so we can support you as best as possible.</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if mso]>
                                                                        </td>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
        
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnTextBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                        <tr>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        <td valign="top" width="600" style="width:600px;">
                                                                        <![endif]-->
                                                                            <!--[if mso]>
                                                                        </td>
                                                                        <![endif]-->
        
                                                                            <!--[if mso]>
                                                                        </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                            </td>
                                                                                            </tr>
                                                                                            </table>
                                                                                            <![endif]-->
                                        </td>
                                    </tr>
        
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
        </table>
        </center>