-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 05:40 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shilengae`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_id` text NOT NULL,
  `name` text NOT NULL,
  `country_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_id`, `name`, `country_id`) VALUES
(1, '603a9e634e7d3', 'Addis Ababa', '6039d14694b2b'),
(2, '603a9e7e5d40d', 'Adama', '6039d14694b2b'),
(3, '603d3b654439d', 'Mobasa', '603a4b4f1af53');

-- --------------------------------------------------------

--
-- Table structure for table `ctoggler`
--

CREATE TABLE `ctoggler` (
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ctoggler`
--

INSERT INTO `ctoggler` (`status`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `faq_id` text NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region_id` text NOT NULL,
  `region` text NOT NULL,
  `country_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tableoperatingcountrylist`
--

CREATE TABLE `tableoperatingcountrylist` (
  `id` int(11) NOT NULL,
  `country_id` text NOT NULL,
  `country` text NOT NULL,
  `short` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableoperatingcountrylist`
--

INSERT INTO `tableoperatingcountrylist` (`id`, `country_id`, `country`, `short`, `status`) VALUES
(3, '604b209213b50', 'Kenya', 'KE', 1),
(4, '604b4effe3643', 'Ethiopia', 'ET', 1),
(5, '604b4f47b8c3d', 'Afghanistan', 'AF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tablepolicies`
--

CREATE TABLE `tablepolicies` (
  `id` int(11) NOT NULL,
  `term_id` text NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tablepolicies`
--

INSERT INTO `tablepolicies` (`id`, `term_id`, `content`, `created_at`, `updated_at`, `flag`, `SelectedCountry`) VALUES
(1, '604b33e7a77251615541223', 'Please read these Terms carefully. Access to, and use of Usabilla products (“Products”), Usabilla services (“Services”), including any of its content, is conditional on your agreement to these Terms. You must read, agree with, and accept all of the terms and conditions contained in these Terms. By creating an account, or by using or visiting our Website, you are bound to these Terms and you indicate your continued acceptance of these Terms.\\r\\n1. Your Usabilla Account\\r\\nIf you create an account on the Website, you are responsible for maintaining the security of your account, and you are fully responsible for all activities that occur under the account and any other actions taken in connection with the account. You agree to provide and maintain accurate, current and complete information, including your contact information for notices and other communications from us and your payment information. You may not use false or misleading information in connection to your account, or trade on the name or reputation of others, and Usabilla may change or remove any information that it considers inappropriate or unlawful, or otherwise likely to expose Usabilla to claims of third parties. You agree that we may take steps to verify the accuracy of information you have provided to us.\\r\\nYou are responsible for taking reasonable steps to maintain the confidentiality of your username and password. You must immediately notify Usabilla of any unauthorized uses of your information, your account or any other security breaches. Usabilla will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions.\\r\\n2. Responsibility of Users of the Website, Products, and/or Services\\r\\nYour access to, and all of your use of the Website, Products, and/or Services must be lawful and must be in compliance with these Terms, and any other agreement between you and Usabilla.\\r\\nWhen accessing or using the Website, Products, and/or Services, you must behave in a civil and respectful manner at all times. We specifically prohibit any use of the Website, Products, and/or Services, and you agree not to use the Website, for any of the following:\\r\\n\\r\\n    • Engaging in conduct that would constitute a criminal offense, giving rise to civil liability or otherwise violate any city, state, national or international law or regulation that would fail to comply with accepted internet protocol;\\r\\n    • Communicating, transmitting, or posting material that is copyrighted or otherwise owned by a third party unless you are the copyright owner or have the permission of the owner to post it;\\r\\n    • Communicating, transmitting, or posting material that reveals trade secrets, unless you own them or have the permission of the owner;\\r\\n    • Communicating, transmitting, or posting material that infringes on any other intellectual property, privacy or publicity right of another;\\r\\n    • Attempting to interfere in any way with the Website, or our networks or network security, or attempting to use our Website to gain unauthorized access to any other computer system;\\r\\n    • Accessing data not intended for you, or logging on to a server or account, which you are not authorized to access;\\r\\n    • Attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorization (or succeeding in such an attempt);\\r\\n    • Attempting to interfere or interfering with the operation of the Website, Products, and/or Services, or our provision of Services to any other users of the Website, our hosting provider or our network, including, without limitation, via means of submitting a virus to the Website, overloading, “flooding”, “mail bombing” or “crashing” the Website.\\r\\n\\r\\nIn addition, if you operate an account, contribute to an account, post material to the Website, post links on the Website, or otherwise make material available by means of the Website (any such material, \\\"Content\\\"), you are solely responsible for the content of, and any harm and damages resulting from that Content. That is the case regardless of whether the Content in question constitutes text, graphics, an audio file, or computer software. By making Content available, you represent and warrant that:\\r\\n\\r\\n    • the downloading, copying and use of the Content will not infringe the proprietary rights, including but not limited to the copyright, patent, trademark or trade secret rights, of any third party;\\r\\n    • if your employer has rights to intellectual property you create, you have either (i) received written permission from your employer to post or make available the Content, including but not limited to any software, or (ii) secured from your employer a written waiver as to all rights in or to the Content;\\r\\n    • you have fully complied with any third party licenses relating to the Content, and have done all things necessary to successfully pass through to end users any required terms;\\r\\n    • the Content does not contain or install any viruses, worms, malware, Trojan horses or other harmful or destructive content;\\r\\n    • the Content is not spam, and does not contain unethical or unwanted commercial content designed to drive traffic to third party sites or boost the search engine rankings of third party sites, or to further unethical or unlawful acts (such as phishing) or mislead recipients as to the source of the material (such as spoofing);\\r\\n    • the Content is not obscene, libelous, hateful or racially or ethnically objectionable, and does not violate the privacy or publicity rights of any third party.\\r\\n\\r\\nIf you delete Content, Usabilla will use reasonable efforts to remove it from the Website and our servers, but you acknowledge that caching or references to the Content may not be made unavailable to the public immediately.\\r\\nYou are responsible for taking precautions as necessary to protect yourself and your computer systems from viruses, worms, Trojan horses, and other harmful or destructive content. Usabilla shall take reasonable precautions to prevent the transmission of harmful content from its technology systems to your technology systems.\\r\\nUsabilla disclaims any liability for any harm or damages resulting from your access or use of the Website, Products, and/or Services, or access or use of non-Usabilla websites.\\r\\nUsabilla has the right (though not the obligation) to (i) refuse or remove any Content that, in Usabilla’s reasonable opinion, violates any Usabilla policy or is in any way harmful or objectionable, or (ii) terminates or denies access to and use of the Website, Products, and/or Services, to any person for any reason, in Usabilla’s sole discretion.\\r\\n3. Fees and Payments\\r\\nBy purchasing Products and/or Services, you agree to pay Usabilla annual subscription fees indicated for such Product or Service. Payments will be due as of the first day you sign up for a Product and/or Services, and will cover an annual period, as indicated when signing up.\\r\\nConfigurations and prices of the Website, Products, and/or Services are subject to change at any time, and Usabilla shall at all times be entitled to modify configurations, fees, prices and quotations, provided that no price changes shall be made applicable to you during a subscription term, and shall only take effect after Usabilla and you have agreed upon an extension, upgrade or renewal of the subscription term. You agree to any such changes if you do not object in writing to Usabilla within seven (7) business days of receiving a notice of Usabilla, or an invoice, incorporating or announcing the fee and/or price changes. All prices are exclusive of, and you shall pay all taxes, duties, levies or fees, or other similar charges imposed on Usabilla or yourself by any taxing authority (other than taxes imposed on Usabilla’s income), related to your order, unless you have provided Usabilla with an appropriate resale or exemption certificate for the delivery location, which is the location where the Products and/or Services are used or performed. In case of changes in law such that a tax is levied that is or becomes irrecoverable with a consequent increase to the costs to Usabilla of delivering the Products and/or Services, whereby and to such an extent Usabilla is entitled to increase its prices accordingly and retroactively.\\r\\n4. Use of Third Party Content and Materials\\r\\nUsabilla has not reviewed, and cannot review, all of the material, including computer software, posted to the Website, and cannot therefore be responsible for that material’s content, use or effects. By operating the Website, Usabilla does not represent or imply that it endorses the material there posted, or that it believes such material to be accurate, useful or non-harmful. The Website may contain content that is offensive, indecent, or otherwise objectionable, as well as content containing technical inaccuracies, typographical mistakes, and other errors. The Website may also contain material that violates the privacy or publicity rights, or infringes the intellectual property and other proprietary rights, of third parties, or the downloading, copying or use of which is subject to additional terms and conditions, stated or unstated. Usabilla disclaims any responsibility for any harm and/or damages resulting from the use or downloading of postings of other parties on the website.\\r\\n5. Content Posted on Other Websites\\r\\nWe have not reviewed, and cannot review, all of the material, including computer software, made available through the websites and webpages to which Usabilla.com links, and that link to Usabilla.com. Usabilla does not have any control over those non-Usabilla websites and webpages, and is not responsible for their contents or their use. By linking to a non-Usabilla website or webpage, Usabilla does not represent or imply that it endorses such website or webpage.\\r\\n6. Copyright Infringement\\r\\nAs Usabilla requires others to respect its intellectual property rights, it respects the intellectual property rights of others. If you believe that material located on or linked to by the Website violates your copyright, you are encouraged to notify Usabilla. Usabilla will, as it is able, respond to all such notices, including as required or appropriate by removing the infringing material or disabling all links to the infringing material. In order to bring infringing material to our attention, you must provide our DMCA Agent with the following information: (a) an electronic or physical signature of the person authorized to act on behalf of the owner of the copyrighted work; (b) an identification of the copyrighted work and the location on the Website of the allegedly infringing work; (c) a written statement that you have a good faith belief that the disputed use is not authorized by the owner, its agent or the law; (d) your name and contact information, including telephone number and email address; and (e) a statement by you that the above information in your notice is accurate and, under penalty of perjury, that you are the copyright owner or authorized to act on the copyright owner’s behalf.\\r\\nThe contact information of our DMCA Agent for notice of claims of U.S. copyright infringement is: Usabilla Inc., attn.: Usabilla DMCA agent, 228 East 45th Street, Suite 9E, New York, NY 10017, + 1-347-694-5321, email: dmca@usabilla.com.\\r\\nIn the case of a user who may infringe or repeatedly infringes upon the copyrights or other intellectual property rights of Usabilla or others, Usabilla may, in its discretion, terminate or deny access to and use of the Website, Products, and/or Services. In the case of such termination, Usabilla will have no obligation to provide a refund of any amounts previously paid to Usabilla to any person in respect of any such termination.\\r\\n7. Trademarks\\r\\nUsabilla, the Usabilla logo, and all other trademarks, service marks, graphics and logos used in connection with the Website, Products, and Services, are trademarks or registered trademarks of Usabilla or Usabilla’s licensors. Other trademarks, service marks, graphics and logos used in connection with the Website, Products, and Services, may be the trademarks of other third parties in which case such license is for the exclusive benefit and use of us unless otherwise stated, or may be the property of their respective owners. Your use of the Website grants you no right or license to reproduce or otherwise use any Usabilla or third party trademarks. Likewise, you grant no right or license to reproduce or otherwise use any of your trademarks, service marks, graphics and/or logos, unless expressly authorized by you.\\r\\n8. Termination\\r\\nYou may terminate your agreement and close your account with Usabilla at any time, effective the last day of your subscription term, by sending an email to support@usabilla.com. Usabilla may terminate its relationship with you, or may terminate or suspend the accessibility to the Website, Products, and/or Services at any time, including the use of any software, (i) if you breach these Terms and/or any other agreement with Usabilla; (ii) if Usabilla reasonably suspects that you are using the Website, Products, and/or Services to breach the law or infringe third party rights; (iii) if Usabilla reasonably suspects that you are trying to unfairly exploit or misuse Usabilla’s policies; (iv) if Usabilla reasonably suspects that you are using the Website, Products, and/or Services fraudulently, or that Products or Services provided to you are being used by a third party fraudulently; (v) if you fail to pay any amounts due to Usabilla; (vi) you violate any applicable law or regulation. Upon termination of your Usabilla account for the above reasons, there will be no refund of fees and you will be denied access to the Website, Products and/or the Services, including all of its data.\\r\\nUsabilla may terminate any agreement and access to your account, if the Services or any part thereof, are no longer legally available in your jurisdiction, or are no longer commercially viable, at Usabilla’s sole discretion. In case of termination or closing of your account by you because of a material breach by Usabilla, without any default by you, or in case of a force majeure on the side of Usabilla, Usabilla will refund pro rata for the remaining period of your subscription any fees or expenses paid by you.\\r\\nIf you believe that Usabilla has failed to perform or the Services are defective, you must notify Usabilla in writing and allow fourteen (14) days for Usabilla to cure the defect. If Usabilla cures the defect within this cure period, Usabilla will not be in default and cannot be held liable for any damages and/or losses in connection to such default. If Usabilla has not cured the defect within this cure period, you may terminate the subscription with immediate effect, upon written notice to Usabilla.\\r\\n9. Changes\\r\\nThe configurations and specifications of the Website, including without limitation all content there available, the Products, and the Services may be amended and/or updated from time to time, at the sole discretion of Usabilla. You are bound by any such changes or updates, unless such changes materially diminish the functionality and value of the Website, Products and/or Services.\\r\\n10. Limitation of Warranties of Usabilla, Its Suppliers and Its Licensors\\r\\nUsabilla warrants to Usabilla customers of paid products and/or services, provided that such customers have paid all fees due, and are not otherwise defaulting any obligations towards Usabilla, an availability of the Products and/or Services (“uptime”) of ninety-eight percent (98%) per month. If for a reason solely attributable to Usabilla the uptime is not met, Usabilla will credit you as “liquidated damages”, $100 for every day, or part of the day, the Products and/or Services are not accessible in violation with the uptime. You agree that it would be difficult to determine the amount of damages that will be suffered by you if the uptime will not be met. You also agree that the above compensation schedule will result in liquidated damages that bear a reasonable proportion to the probable loss and the amount of your actual loss. The aforementioned liquidated damages shall be the sole and exclusive remedy in the event the uptime has not been met by Usabilla. However, if the Products and/or Services are not available to you for a reason solely attributable to Usabilla for a continuing period of five (5) days or more, you may terminate your agreement in writing with immediate effect, and you may request return of fees paid by you related to the unavailable Products and/or Services, pro-rata the remaining unused term of your agreement.\\r\\nUsabilla and its licensors make no warranties or representations whatsoever with respect to the Website, Products, and Services, or any linked site or its content, including the content, information and materials on it or the accuracy, completeness, or timeliness of the content, information and materials. We also do not warrant or represent that your access to or use of the Website, Products, and/or Services, or any linked site will be uninterrupted or free of errors or omissions, that defects will be corrected, or that the Website, Products, and/or Services, or any linked site is free of computer viruses or other harmful components. We assume no responsibility, and shall not be liable for any damages to, or viruses that may infect, your computer equipment or other property on account of your use of the Products or Services, or your access to, use of, or browsing of the Website, or your downloading or uploading of any Content from or to the Website. If you are dissatisfied with the Website, your sole remedy is to discontinue using the Website.\\r\\nNo advice, results or information, whether oral or written, obtained by you from Usabilla, or through the Website, shall create any warranty not expressly made herein. Usabilla does not necessarily endorse, support, sanction, encourage or agree with any content or any user content, or any opinion, recommendation, content, link, data or advice expressed or implied therein, and Usabilla expressly disclaims any and all liability in connection with user content and any other content, materials or information available on or through the Website, Products, and/or Services, created or provided by users or other third parties.\\r\\nPlease note that some jurisdictions may not allow the exclusion of implied warranties, so some of the above exclusions may not apply to you. Check your local laws for any restrictions or limitations regarding the exclusion of implied warranties.\\r\\n11. Limitation of Liability of Usabilla, its Suppliers and its Licensors\\r\\nUnder no circumstances shall any party, its subsidiaries and affiliates, their respective directors, officers, employees or agents, and other representatives, be liable for any indirect, consequential, incidental, special, or punitive damages, including but not limited to lost profits and business interruption, whether in contract or in tort, including negligence, arising in any way from the use of the Website, Products, Services, and/or the Contents thereof, or of any hyperlinked website even if such party is expressly advised of the possibility of such damages. With the exception of damages related to legally proven or admitted intellectual property infringement caused by Products and/or Services as delivered by a party without any third party content, in no event shall a party’s liability exceed the total sums received by Usabilla from you during the twelve (12) month period immediately prior to the date the damages first occurred.\\r\\n12. Your Representations and Warranties\\r\\nYou represent and warrant that your use of the Website, Products, and/or Services will be in accordance with any agreement between you and Usabilla, the Usabilla Privacy Policy, these Terms, and with any applicable laws and regulations, including without limitation any local laws or regulations in your country, state, city, or other governmental area, regarding online conduct and acceptable content, and including all applicable laws regarding the transmission of technical data exported from the country in which you reside, and with any other applicable policy or terms and conditions.\\r\\n13. Indemnification\\r\\nSubject to the limitations set forth herein, the Parties agree to defend, indemnify, and hold each other harmless, including its subsidiaries and affiliates, their respective directors, officers, employees or agents, and other representatives, from and against all claims, losses, damages, liabilities, and costs (including but not limited to reasonable attorneys’ fees and court costs), arising out of, relating to or in connection with (i) a material violation of these Terms, or any agreement between the Parties, or (ii) any allegation that any information or material (including any Content) violates any rights of any third party.\\r\\nYou understand and agree that, by using the Products and/or Services, you are solely responsible for any data, including personally identifiable information, collected or processed via our Products and/or Services. You will defend, indemnify, and hold Usabilla harmless, without any limitation, for all damages in connection to (alleged) violations of any privacy laws through the use of the Products and/or Services under your account.\\r\\n14. Miscellaneous\\r\\nEach party shall take out adequate insurance in order to cover its risks hereunder, including but not limited to a general- and product liability insurance. Regarding the security, confidentiality and integrity of data, each party is responsible for maintaining appropriate technical and organizational measures for the protection of data processed on their own systems and on third party systems that are in use by the involved party.\\r\\nUsabilla will not be liable for any delay in performing or failure to perform any of its obligations to you caused by events beyond its reasonable control. Usabilla will notify you promptly in writing of the reasons for the delay or stoppage (and the likely duration) and will take all reasonable steps to overcome the delay or stoppage.\\r\\nIf you are located in the United States and use or access the Website, Products, and/or Services from the United States, these Terms, the Website, Products, and/or Services and any and all agreements between you and Usabilla shall be governed by and construed in accordance with the laws of the state of New York, without giving effect to the United Nations Convention on the Contracts for the International Sale of Goods. All disputes between you and Usabilla shall be resolved under the International Arbitration Rules of the American Arbitration Association in front of a sole arbitrator. The place of arbitration shall be New York City, New York. The language of the arbitration shall be English. Any award, verdict or settlement issued under such arbitration may be entered by any party for order of enforcement by any court of competent jurisdiction.\\r\\nIf you are located outside the United States and use or access the Website, Products, and/or Services from outside the United States, these Terms, the Website, Products, and/or Services and any and all agreements between you and Usabilla shall be governed by and construed in accordance with the laws of the Netherlands, without giving effect to the United Nations Convention on the Contracts for the International Sale of Goods. All disputes between you and Usabilla shall be exclusively resolved by the Dutch Courts in Amsterdam.\\r\\nAny cause of action against a party, regardless whether in contract, tort or otherwise, must commence within one (1) year after the cause of action accrues. otherwise, such cause of action is permanently barred.\\r\\nIf any part of these Terms is held invalid or unenforceable, that part will be construed to reflect the Parties’ original intent, and the remaining portions will remain in full force and effect. A waiver by either party of any term or condition of these Terms or any breach thereof, in any one instance, will not waive such term or condition or any subsequent breach thereof. You may only assign your rights under these Terms to any party that consents to, and agrees to be bound by, the terms hereof in writing. Usabilla may assign its rights under these Terms at its sole discretion. These Terms will be binding upon and will inure to the benefit of the parties, their successors and permitted assigns. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of the Terms, or your use of the Website, Products, and/or Services.\\r\\nA Special Note About Children\\r\\nThe Website is not designed or intended for use by children under the age of 16, and our Products and Services may not be purchased by children under the age of 16. We do not intentionally gather personal information from visitors who are under the age of 16. If you are under the age of 16, you are not permitted to submit any personal information to us. If you are under the age of 16, you should use the Website only with consent of a parent or guardian.\\r\\n', 1615541223, 0, 1, 'EN');

-- --------------------------------------------------------

--
-- Table structure for table `tableportalusers`
--

CREATE TABLE `tableportalusers` (
  `id` int(11) NOT NULL,
  `admin_id` text NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableportalusers`
--

INSERT INTO `tableportalusers` (`id`, `admin_id`, `username`, `password`) VALUES
(1, '32ed2e3x32e62bxvs53a5r', 'AD', '$2y$10$SgzMy1irYXf2l5CMfpyrEuE5JRyJlOYSOXiU0QwzdtkQ755NJnMWC');

-- --------------------------------------------------------

--
-- Table structure for table `tableusers`
--

CREATE TABLE `tableusers` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `country` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `gender` text NOT NULL,
  `birth` text NOT NULL,
  `career` text NOT NULL,
  `experience` text NOT NULL,
  `salary` text NOT NULL,
  `profile_image` text NOT NULL,
  `social_profile_image` text DEFAULT NULL,
  `calling_code` int(11) NOT NULL,
  `language` text NOT NULL DEFAULT 'en-US',
  `verified` int(11) NOT NULL,
  `mverified` int(11) NOT NULL,
  `email_verified_at` int(11) NOT NULL,
  `business` int(11) NOT NULL,
  `company` text NOT NULL,
  `last_online_at` int(11) NOT NULL,
  `last_logged_in` int(11) NOT NULL,
  `login_attempt` int(11) NOT NULL,
  `time_spent` text NOT NULL,
  `last_seen_ip` text NOT NULL,
  `last_device` text NOT NULL,
  `SelectedCountry` text NOT NULL,
  `joined` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `throttling`
--

CREATE TABLE `throttling` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `counter` int(11) NOT NULL,
  `throttled` int(11) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableoperatingcountrylist`
--
ALTER TABLE `tableoperatingcountrylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablepolicies`
--
ALTER TABLE `tablepolicies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableportalusers`
--
ALTER TABLE `tableportalusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableusers`
--
ALTER TABLE `tableusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttling`
--
ALTER TABLE `throttling`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableoperatingcountrylist`
--
ALTER TABLE `tableoperatingcountrylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tablepolicies`
--
ALTER TABLE `tablepolicies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tableportalusers`
--
ALTER TABLE `tableportalusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tableusers`
--
ALTER TABLE `tableusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `throttling`
--
ALTER TABLE `throttling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
